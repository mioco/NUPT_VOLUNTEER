<?php
namespace User\Controller;
use Common\Controller\HomeBaseController;
class UserinfoController extends HomeBaseController {
	function index(){
		$userid=I('get.id');
		$posts = M('recruit')
		->alias('r')
		->join(C('DB_PREFIX').'posts p on r.tid=p.id')
		->join(C('DB_PREFIX').'org_relationships orl on p.post_author=orl.uid')
		->join(C('DB_PREFIX').'org o on orl.oid=o.oid')
		->where(array('r.uid'=>$userid,'r.status'=>1))
		->field('o.oid,org_name,logo,post_title,post_excerpt,smeta,tid,r.createtime')
		->select();
		$user=M('users')->where(array("id"=>$userid))->find();
		$org = M('org_relationships')
		->alias('orl')
		->join(C('DB_PREFIX').'org o on orl.oid=o.oid')
		->where(array('orl.uid'=>$userid))
		->find();
		$this->assign('posts',$posts);
		$this->assign($user);
		$this->assign('org',$org);
    	$this->display(':userinfo');
	}
}
?>