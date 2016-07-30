<?php
namespace Orgadmin\Controller;
use Common\Controller\AdminbaseController;
class OrgadminController extends AdminbaseController{
	function _initialize() {
		parent::_initialize();
		$this->orgadmin=D("Common/Org");
		$this->users=D("Common/users");
		$this->orgrl=D("Common/org_relationships");
	}

	function index() {
		$admin_id = get_current_admin_id();
		$isExist = $this->orgadmin -> where(array('admin_id'=>$admin_id)) -> find();
		if (!$isExist) {$this->display('noOrg');die();}
		else {
            $page = $this->page($count, 20);
            $member = $this->member($isExist['oid'],1);
            $un_check = $this->member($isExist['oid'],0);
            $count['member'] = count($member);
            $count['un_check'] = count($un_check);
            $all_time = 0;
            foreach ($member as $m) {
                $all_time += $m['duration'];
            }
            $isExist['time'] = $all_time;
            $this->assign("page", $page->show('admin'));
            $this->assign('member_count',$count);
            $this->assign('member',$member);
            $this->assign('un_check',$un_check);
			$this->assign('org',$isExist);
		}
		$this->display(":index");
	}
	function create() {
		$admin_id = get_current_admin_id();
		$orgLogo = $this->avatar_upload();
		$data = array(
			"org_name"=>$_POST['orgName'],
			"org_des"=>$_POST['orgDes'],
			"admin_id"=>$admin_id,
            'create_time' => time(),
			"logo"=>$orgLogo['savename']);
		$add1 = $this->orgadmin ->add($data);
		if ($add1) {
			$add2 = $this->orgrl->add(array('oid'=>$add1,"uid"=>$admin_id));
			if ($add2) echo '创建成功';
			else error('创建失败');
		}else error('创建失败');
	}
	function member($oid,$status) {
        $where['orl.oid'] = $oid;
        $where['status'] = $status;
        $member = M('org_relationships')
        ->alias('orl')
        ->join(C('DB_PREFIX').'users u on orl.uid=u.id')
        ->join(C('DB_PREFIX').'faculty_relationships fr on u.id=fr.user_id')
        ->join(C('DB_PREFIX').'faculty f on fr.faculty_id=f.fid')
        ->field('u.id,username,user_number,duration,avatar,major_id,fa_name')
        ->where($where)
        ->order('duration desc')
        ->limit($page->firstRow . ',' . $page->listRows)
        ->select();
        $major = M('faculty');
        foreach ($member as &$m) {
            $m['major'] = $major->where(array('fid'=>$m['major_id']))->getField('fa_name');
        }
        return $member;
	}

    function avatar(){
    	$userid=sp_get_current_userid();
		$user=$this->users_model->where(array("id"=>$userid))->find();
		$this->assign($user);
    	$this->display();
    }
    
    function avatar_upload(){
    	$config=array(
    			'FILE_UPLOAD_TYPE' => sp_is_sae()?"Sae":'Local',//TODO 其它存储类型暂不考虑
    			'rootPath' => './'.C("UPLOADPATH"),
    			'savePath' => './orgLogo/',
    			'maxSize' => 512000,//500K
    			'saveName'   =>    array('uniqid',''),
    			'exts'       =>    array('jpg', 'png', 'jpeg'),
    			'autoSub'    =>    false,
    	);

    	$upload = new \Think\Upload($config);
    	$info=$upload->upload($_FILES);
    	if (!$info) {
    		echo $upload->getError();
    	}else{return $info['orgLogo'];}
    }
    
    function avatar_update(){
    	if(!empty($_SESSION['avatar'])){
    		$targ_w = intval($_POST['w']);
    		$targ_h = intval($_POST['h']);
    		$x = $_POST['x'];
    		$y = $_POST['y'];
    		$jpeg_quality = 90;
    		
    		$avatar=$_SESSION['avatar'];
    		$avatar_dir=C("UPLOADPATH")."avatar/";
    		if(sp_is_sae()){//TODO 其它存储类型暂不考虑
    			$src=C("TMPL_PARSE_STRING.__UPLOAD__")."avatar/$avatar";
    		}else{
    			$src = $avatar_dir.$avatar;
    		}
    		
    		$avatar_path=$avatar_dir.$avatar;
    		
    		
    		if(sp_is_sae()){//TODO 其它存储类型暂不考虑
    			$img_data = sp_file_read($avatar_path);
    			$img = new \SaeImage();
    			$size=$img->getImageAttr();
    			$lx=$x/$size[0];
            	$rx=$x/$size[0]+$targ_w/$size[0];
            	$ty=$y/$size[1];
            	$by=$y/$size[1]+$targ_h/$size[1];
    			
    			$img->crop($lx, $rx,$ty,$by);
    			$img_content=$img->exec('png');
    			sp_file_write($avatar_dir.$avatar, $img_content);
    		}else{
    			$image = new \Think\Image();
    			$image->open($src);
    			$image->crop($targ_w, $targ_h,$x,$y);
    			$image->save($src);
    		}
    		
    		$userid=sp_get_current_userid();
    		$result=$this->users_model->where(array("id"=>$userid))->save(array("avatar"=>$avatar));
    		$_SESSION['user']['avatar']=$avatar;
    		if($result){
    			$this->success("头像更新成功！");
    		}else{
    			$this->error("头像更新失败！");
    		}
    		
    	}
    }
    
    function check(){
        $org = M('org_relationships');
        if($_GET){
            if($_GET['status']) {
                if ( $org->where(array('uid'=>$_GET['id']))->save(array('status'=>1))!=false) {
                    $this->success("审核成功！");
                } else {
                    $this->error("审核出错！");
                }
            }else{
                if ($org->where(array('uid'=>$_GET['id']))->delete()!=false) {
                    $this->success('已拒绝该申请');
                }else{
                    $this->error('发生错误');
                }
            }
        }
    }
}
?>