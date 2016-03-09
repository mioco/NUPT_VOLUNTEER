<?php
namespace Orgadmin\Controller;
use Common\Controller\HomeBaseController;
class OrgController extends HomeBaseController{
	function _initialize() {
		parent::_initialize();
		$this->orgadmin=D("Common/Org");
		$this->users=D("Common/users");
		$this->orgrl=D("Common/org_relationships");
		$this->posts=D("Common/posts");
	}
	function index() {
		$org = M('org')->select();
		$arrLength = count($org); 
		$page = $this->page($arrLength, 16);
		$org = M('org')->limit($page->firstRow . ',' . $page->listRows)->select();
		$count = M('org_relationships');
		$p_count = M('posts');
		foreach ($org as &$o) {
			$o['count'] = $count->where(array('oid'=>$o['oid']))->count();
			$o['posts_count'] = $p_count->where(array('post_author'=>$o['admin_id']))->count();
		}        
		$sOrg = $org;
		shuffle($sOrg);
		$orgNews = $this->posts
		->alias('p')
		->join(C('DB_PREFIX').'term_relationships tr on p.id=tr.object_id')
		->join(C('DB_PREFIX').'terms t on tr.term_id=t.term_id')
		->join(C('DB_PREFIX').'org_relationships orl on p.post_author=orl.uid')
		->join(C('DB_PREFIX').'org o on orl.oid=o.oid')
		->where('t.parent=3')->limit(5)->field('post_title,p.id,o.oid,post_modified,org_name')->order('post_modified desc,createtime desc')->select();
		// $join=M('org_relationships')->alias('orl')
		// ->join(C('DB_PREFIX').'org o on orl.oid=o.oid')
		// ->field('username,org_name')
		// ->where('user_type=2')
		// ->limit(5)->order('createtime desc')->select();
		$this->assign('orgNews', $orgNews);
		$this->assign("page", $page->show('admin'));
		$this->assign('sOrg',$sOrg);
		$this->assign('org',$org);
		$this->display(':orgList');
	}
	function orgItem(){
		$this->assign('oid',$_GET['oid']);
		$this->display('/orgItem');
		// $data = $this->orgCenter($_GET['oid']);
	}
	function orgCenter($oid=''){
		if ($_GET['uid']) $where['orl.uid'] = sp_get_current_userid();
		if ($oid) $where['o.oid']=$oid;
		$uid = get_current_userid();
		$org = $this->orgrl
		->alias('orl')
		->join(C('DB_PREFIX').'org o on o.oid = orl.oid')
		->where($where)->find();
		$org['p_count'] = $count;
		$member = $this->orgrl
		->alias('orl')
		->join(C('DB_PREFIX').'users u on u.id = orl.uid')
		->field('avatar,username,duration,user_number')
		// ->limit($page->firstRow . ',' . $page->listRows)
		->where(array('orl.oid'=>$org['oid']))->select();
		$org['u_count'] = count($member);
		$org['ratio'] = round($org['u_count']*100/(M('users')->count()),1);
		foreach ($member as $key) {
			$org['time'] += $key['duration'];
		}
		$this->post_list($org['admin_id']);
		$this->assign('org',$org);
		$this->assign('member',$member);
		$this->display('/index');
	}
	function post_list($admin_id){		
		$count = $this->posts
		->alias('p')
		->join(C('DB_PREFIX').'term_relationships trl on p.id=trl.object_id')
		->join(C('DB_PREFIX').'terms t on trl.term_id=t.term_id')
		->field('tid,smeta,post_date,post_title,post_address,duration,post_excerpt')
		->where(array('post_author'=>$admin_id,'t.parent'=>3))->count();
		$page = $this->page($count, 4);
		$posts = $this->posts
		->alias('p')
		->join(C('DB_PREFIX').'term_relationships trl on p.id=trl.object_id')
		->join(C('DB_PREFIX').'terms t on trl.term_id=t.term_id')
		->field('tid,smeta,post_date,post_title,post_address,duration,post_excerpt')
		->where(array('post_author'=>$admin_id,'t.parent'=>3))
		->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->assign('posts',$posts);
		$this->assign('page', $page->show('admin'));
	}
	function orgJoin(){
		if(sp_is_user_login()){
			$uid = I('get.uid','','htmlspecialchars');
			$oid = I('get.oid','','htmlspecialchars');
			$orlDB = M('org_relationships');
			if ($oid&&$uid) {		
				$orgRL = $orlDB->where(array('uid'=>$uid))->find();
				if($orgRL){
					if ($orgRL['oid']==$oid) {
						echo '请求失败，你已在该社团中。';
					}else{
						echo '请求失败，你已加入其它社团。';
					}
				}else{
					$data['uid'] = $uid;
					$data['oid'] = $oid;
					$data['createtime']=date("Y-m-d H:i:s",time());
					if($orlDB->add($data)) echo '申请成功，等待管理员审核。';
				}
			}    		
    	}else{
    		echo '请登录后再操作。';
    	}

	}
}