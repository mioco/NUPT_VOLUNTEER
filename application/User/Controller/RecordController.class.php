<?php
namespace User\Controller;
use Common\Controller\MemberbaseController;
class RecordController extends MemberbaseController{
	function index(){
		$this->recordInfo($_REQUEST['uid']);
        $this -> display(':record');
	}

    function recordInfo($uid) {
        $userInfo = M('users')
        ->alias('u')
        ->join(C('DB_PREFIX').'faculty_relationships fr on u.id = fr.user_id')
        ->join(C('DB_PREFIX').'faculty f on fr.faculty_id = f.fid')
        ->field('username, user_number, fa_name, sex, birthday, major_id, duration')
        ->where(array('u.id'=>$uid))
        ->find();
        $userInfo['major'] = M('faculty')->where(array('fid'=>$userInfo['major_id']))->getField('fa_name');
        $tid = M('recruit') -> where(array('uid' => $uid)) -> field('tid') -> select();
        foreach ($tid as $t) {
            $tidString = $tidString.$t['tid'].',';
        }
        $where['tid'] = $tid ? array("in", $tidString) : 'NULL';
        $where['active_status'] = 2;
        $record = M('term_relationships')
        ->alias('tr')   
        ->join(C('DB_PREFIX').'posts p on tr.object_id = p.id')
        ->where($where)
        ->field('post_title,post_address,ac_start,ac_end,duration')
        ->select();
        $this -> assign('userInfo',$userInfo);
        $this->assign("record",$record);
        // var_dump($record);
    }
}
?>