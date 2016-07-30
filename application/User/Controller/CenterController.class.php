<?php

/**
 * 会员中心
 */
namespace User\Controller;
use Common\Controller\MemberbaseController;
class CenterController extends MemberbaseController {
	
	protected $users_model;
	function _initialize(){
		parent::_initialize();
		$this->users_model=D("Common/Users");
	}
    //会员中心
	public function index() {
		$userid=sp_get_current_userid();
		$posts = M('recruit')
		->alias('r')
		->join(C('DB_PREFIX').'term_relationships tr on r.tid=tr.tid')
		->join(C('DB_PREFIX').'posts p on p.id=object_id')
		->join(C('DB_PREFIX').'org_relationships orl on p.post_author=orl.uid')
		->join(C('DB_PREFIX').'org o on orl.oid=o.oid')
		->where(array('r.uid'=>$userid,'r.status'=>1))
		->field('o.oid,org_name,logo,post_title,post_excerpt,smeta,tr.tid,r.createtime')
		->select();
		$user=$this->users_model->where(array("id"=>$userid))->find();
		$org = M('org_relationships')
		->alias('orl')
		->join(C('DB_PREFIX').'org o on orl.oid=o.oid')
		->where(array('orl.uid'=>$userid))
		->find();
		$this->assign('posts',$posts);
		$this->assign($user);
		$this->assign('org',$org);
    	$this->display(':center');
    }
}
