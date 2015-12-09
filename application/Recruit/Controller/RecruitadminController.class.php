<?php
namespace Recruit\Controller;
use Common\Controller\AdminbaseController;
class RecruitadminController extends AdminbaseController{
	
	protected $recruit_model;
	protected $posts_model;
	protected $term_relationships;
	protected $users_model;
	protected $faculty_model;
	protected $faculty_relationships;
	
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
		$this->memberList(0);
	}
	function member(){
		$this->memberList(1);
	}
	function memberList($status){
		$where['jo.status'] = $status;
		if ($_GET['id']) $where['jo.tid'] = $_GET['id'];
		if ($_SESSION['ADMIN_ID'] != 1) {
			$where['post_id'] = $_SESSION['ADMIN_ID'];
		}
		$page = $this->page($count, 20);
		$menber=$this->recruit_model
		->alias('jo')
		->join(C('DB_PREFIX').'users u on jo.uid = u.id')
		->join(C('DB_PREFIX').'faculty_relationships fr on jo.uid = fr.user_id')
		->join(C('DB_PREFIX').'faculty f on fr.major_id = f.fid')
		->where($where)
		->field('jo.id,u.id as uid,user_number,username,user_email,status,fa_name,faculty_id,org')
		->limit($page->firstRow . ',' . $page->listRows)
		->order("status")
		->select();
		foreach ($menber as &$m) {
			$m['faculty'] = $this->faculty->where(array('fid'=>$m['faculty_id']))->getField('fa_name');
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
		//ac_status {0:start;1:end}
		switch ($_GET['ac_status']) {
			case '0':
				if ($_GET['status']) {$this->error('活动不在招募状态！');die();}
				$data["active_status"]=1;
				$ids = isset($_POST['ids']) ? join(',', $_POST['ids']) : $_GET['id'];
				if ($this->posts_model->where("id in ($ids)")->save($data)!==false) {
					$this->success("活动已开始！");
				}else {
					$this->error("活动开始失败！");
				}
				break;
			case '1':
				$data["active_status"]=2;
				$ids = isset($_REQUEST['ids']) ? join(",",$_POST['ids']) : $_GET['id'];
				if (1) {
					$where['re.status'] = 1;
					$where['tr.object_id'] = array('in', $ids);
					$uid = $this->term_relationships
					->alias('tr')
					->join(C('DB_PREFIX').'recruit re on tr.tid = re.tid')
					->where($where)
					->field('re.uid')->select();
					foreach ($uid as $u) {
						$duration = $this->users_model->where(array('id'=>$u['uid']))->getField('duration')+$_GET['timeTake'];
						$insert = $this->users_model->where(array('id'=>$u['uid']))->save(array('duration'=>$duration));
						if (!$insert) {
							$this->error("添加时长失败！");
							return false;
						}
					}
				} else {
					$this->error("取消审核失败！");
				}
				break;
			
			default:
				$this->error('错误的操作');
				break;
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