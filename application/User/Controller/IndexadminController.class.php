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
        $uid=$_GET['id'];
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
        $this -> display(':record');
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
