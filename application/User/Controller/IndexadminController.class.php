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
        ->alias('u')
        ->join(array('RIGHT JOIN '.C('DB_PREFIX').'faculty_relationships fr on u.id=fr.user_id',
            C('DB_PREFIX').'faculty f on fr.major_id=f.fid',
            'LEFT JOIN '.C('DB_PREFIX').'org_relationships orl on u.id=orl.uid'
            ))
        ->field('user_number,username,fa_name,f.fid,parent,u.duration')
    	->where(array("user_type"=>2))
    	->order("u.create_time DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
        foreach ($lists as &$l) {
            $l['faculty'] = M('faculty')->where(array('fid'=>$l['parent']))->getField('fa_name');
        }
        // var_dump($lists);
    	$this->assign('lists', $lists);
    	$this->assign("page", $page->show());
    	
    	$this->display(":index");
    }
    function record() {
        R('User/Record/recordInfo',array($_GET['id']));
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
