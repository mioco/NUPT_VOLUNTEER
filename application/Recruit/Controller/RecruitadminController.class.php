<?php
namespace Recruit\Controller;
use Common\Controller\AdminbaseController;
class RecruitadminController extends AdminbaseController{
	
	protected $recruit_model;
	protected $posts_model;
	
	function _initialize(){
		parent::_initialize();
		$this->recruit_model=D("Common/recruit");
		$this->posts_model=D("Common/posts");
		$this->term_relationships=D('Common/term_relationships');
		$this->users_model=D('Common/users');
		$this->faculty_relationships=D('Common/faculty_relationships');
		$this->faculty=D('Common/faculty');
	}

	function index($table=""){
		$where['parent']="3";
		if(!empty($table)){
			$where['post_table']=$table;
		}
		if ($_SESSION['ADMIN_ID'] != 1) {
			$where['post_author'] = $_SESSION['ADMIN_ID'];
		}
		$where['re.status'] = 1;
		$page = $this->page($count, 20);
		$article=$this->posts_model
		->alias('po')
		->join(C ( 'DB_PREFIX' ).'term_relationships re on po.id = re.object_id')
		->join(C ( 'DB_PREFIX' ).'terms te on re.term_id = te.term_id')
		->join(C ( 'DB_PREFIX' ).'users u on po.post_author = u.id')
		->where($where)
		->field('po.id,re.tid,post_date,ac_start,ac_end,post_title,user_number,active_status,re.status,po.duration')
		->limit($page->firstRow . ',' . $page->listRows)
		->order("post_modified DESC")
		->select();
		//poster name
		foreach ($article as &$ar) {
			$un_count = $this->recruit_model->where(array('status'=>'0','tid'=>$ar['tid']))->count();
			$recruit_count = $this->recruit_model->where(array('status'=>'1','tid'=>$ar['tid']))->count();
			$ar['recruit_count'] = $recruit_count;
			$ar['un_check'] = $un_count;
		}
		$this->assign("article",$article);
		// $this->assign("count",$count);
		$this->assign("Page", $page->show('Admin'));
		$this->display(":index");
	}
	
	function not_check() {
		$where['jo.status'] = 0;
		if ($_GET['id']) $where['jo.tid'] = $_GET['id'];
		if ($_SESSION['ADMIN_ID'] != 1) {
			$where['post_id'] = $_SESSION['ADMIN_ID'];
		}
		$recruit=$this->recruit_model
		->alias('jo')
		->join(C ( 'DB_PREFIX' ).'users u on jo.uid = u.id')
		->join(C ( 'DB_PREFIX' ).'term_relationships re on jo.tid = re.tid')
		->join(C ( 'DB_PREFIX' ). 'posts po on re.object_id = po.id')
		->field('user_number,username,user_email,post_title,jo.status,jo.id')
		->where($where)
		->limit($page->firstRow . ',' . $page->listRows)
		->order("createtime DESC")
		->select();
		$count=count($recruit);
		$page = $this->page($count, 20);
		$this->assign("recruit",$recruit);
		$this->assign("Page", $page->show('Admin'));
		$this->display();
	}
	function member(){
		$page = $this->page($count, 20);
		$menber=$this->recruit_model
		->alias('jo')
		->join(C('DB_PREFIX').'users u on jo.uid = u.id')
		->join(C('DB_PREFIX').'faculty_relationships fr on jo.uid = fr.user_id')
		->join(C('DB_PREFIX').'faculty f on fr.major_id = f.fid')
		->where(array('tid'=>$_GET['id'],'status'=>1))
		->field('jo.id,u.id as uid,user_number,username,user_email,status,fa_name,faculty_id,org')
		->limit($page->firstRow . ',' . $page->listRows)
		->order("status")
		->select();
		foreach ($menber as &$m) {
			$faculty = $this->faculty->where(array('fid'=>$m['faculty_id']))->getField('fa_name');
		}
		$this->assign("menber",$menber);
		$this->assign("Page", $page->show('Admin'));
		$this->display();
	}
	function delete(){
		if(isset($_GET['tid'])){
			$tid = intval(I("get.tid"));
			$data['status']=0;
			if ($this->term_relationships->where("tid=$tid")->save($data)) {
				$this->success("删除成功！");
			} else {
				$this->error("a,删除失败！");
			}
		}
		if(isset($_POST['ids'])){
			$ids=join(",",$_POST['ids']);
			if ($this->recruit_model
				->join('sp_posts on ')
				->where("id in ($ids)")->delete()!==false) {
				$post_table=ucwords(str_replace("_", " ", $post_table));
				$post_table=str_replace(" ","",$post_table);
				$post_table_model=M($post_table);
				$pk=$post_table_model->getPk();
				
				$post_table_model->create(array("recruit_count"=>array("exp","recruit_count+1")));
				$post_table_model->where(array($pk=>intval($_POST['post_id'])))->save();
				
				$post_table_model->create(array("last_recruit"=>time()));
				$post_table_model->where(array($pk=>intval($_POST['post_id'])))->save();
				$this->success("删除成功！");
			} else {
				$this->error("删除失败！");
			}
		}
	}
	
	function check(){
		if(isset($_POST['ids']) && $_GET["check"]){
			$data["status"]=1;
				
			$ids=join(",",$_POST['ids']);
			
			if ( $this->recruit_model->where("id in ($ids)")->save($data)!==false) {
				$this->success("审核成功！");
			} else {
				$this->error("审核失败！");
			}
		}
		if(isset($_POST['ids']) && $_GET["uncheck"]){
			$data["status"]=0;
			$ids=join(",",$_POST['ids']);
			if ( $this->recruit_model->where("id in ($ids)")->save($data)!==false) {
				$this->success("取消审核成功！");
			} else {
				$this->error("取消审核失败！");
			}
		}
	}
	
	function active_status(){
		if((isset($_REQUEST['id'])) && $_GET["active_start"]){
			$data["active_status"]=1;
			isset($_POST['ids']) ? $ids=join(",",$_POST['ids']) : $ids = $_GET['id'];
			if ( $this->posts_model->where("id in ($ids)")->save($data)!==false) {
				$this->success("活动已开始！");
			} else {
				$this->error("活动开始失败！");
			}
		}
		if((isset($_REQUEST['id'])) && $_GET["active_end"]){
			if ($_GET['status'] === '2') {
				$this->error('活动已经是结束的了！');
			}else{			
				$data["active_status"]=2;
				$ids = isset($_POST['ids']) ? join(",",$_POST['ids']) : $_GET['id'];
				if ( $this->posts_model->where("id in ($ids)")->save($data)!==false) {
					$uid = $this->posts_model
					->alias('po')
					->join(C('DB_PREFIX').'term_relationships tr on po.id = tr.object_id')
					->join(C('DB_PREFIX').'recruit re on tr.tid = re.tid')
					->field('re.uid')->find();
					foreach ($uid as $u) {
						$insert = $this->users_model->where(array('id'=>$u))->save(array('duration'=>$_GET['duration']));
						if (!$insert) {
							$this->error("添加时长失败！");
							return false;
						}
					}
					$this->success("活动已结束！");
				} else {
					$this->error("取消审核失败！");
				}
			}
		}
	}
	// if ($result!==false){							
	// 	//评论计数
	// 	$post_table=ucwords(str_replace("_", " ", $post_table));
	// 	$post_table=str_replace(" ","",$post_table);
	// 	$post_table_model=M($post_table);
	// 	$pk=$post_table_model->getPk();
		
	// 	$post_table_model->create(array("recruit_count"=>array("exp","recruit_count+1")));
	// 	$post_table_model->where(array($pk=>intval($_POST['post_id'])))->save();
		
	// 	$post_table_model->create(array("last_recruit"=>time()));
	// 	$post_table_model->where(array($pk=>intval($_POST['post_id'])))->save();
	// } else {
	// 	$this->error("报名失败！");
	// }
}