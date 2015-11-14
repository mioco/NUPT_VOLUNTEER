<?php
namespace User\Controller;
use Common\Controller\MemberbaseController;
class RecordController extends MemberbaseController{
	function index(){
		$uid=sp_get_current_userid();
		$user=M("Users");
		$tid = M('recruit') -> where(array('uid' => $uid)) -> field('tid') -> select();
		foreach ($tid as $t) {
			$tidString = $tidString.$t['tid'].',';
		}
		if ($tid) {
			$where = array("tid" => array("in", $tidString));
		}else{
			$where = 'tid = NULL';
		}
		$record = M('term_relationships')
		->alias('tr')	
		->join(C('DB_PREFIX').'posts p on tr.object_id = p.id')
		->where($where)
		->field('post_title,post_address,ac_start,ac_end,duration')
		->select();
		$fr = M('faculty_relationships') -> where("user_id=$uid") -> find();
		$fa = M('faculty');
		$faculty = $fa -> where(array('fid'=>$fr['faculty_id'])) -> field('fa_name') -> find();
		$major = $fa -> where(array('fid'=>$fr['major_id'])) -> field('fa_name') -> find();
		$userInfo = $user -> where("id=$uid") -> field('user_number,username,sex,birthday,duration') -> find();
		$userInfo['faculty'] = $faculty['fa_name'];
		$userInfo['major'] = $major['fa_name'];
		$this -> assign('userInfo',$userInfo);
		$this->assign("record",$record);
		$this->display(":record");
	}
}
?>