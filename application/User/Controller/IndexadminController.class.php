<?php

/**
 * 会员
 */
namespace User\Controller;
use Common\Controller\AdminbaseController;
class IndexadminController extends AdminbaseController {
    function index(){
    	$users_model=M("Users");
    	$count=$users_model->where(array("user_type"=>2))->count();
    	$page = $this->page($count, 20);
    	$lists = $users_model
    	->where(array("user_type"=>2))
    	->order("create_time DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display(":index");
    }
    function record() {
        $this->recordInfo($_GET['id']);
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
    }
    function ban(){
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status','0');
    		if ($rst) {
    			$this->success("会员拉黑成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员拉黑失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    function cancelban(){
    	$id=intval($_GET['id']);
    	if ($id) {
    		$rst = M("Users")->where(array("id"=>$id,"user_type"=>2))->setField('user_status','1');
    		if ($rst) {
    			$this->success("会员启用成功！", U("indexadmin/index"));
    		} else {
    			$this->error('会员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
}
