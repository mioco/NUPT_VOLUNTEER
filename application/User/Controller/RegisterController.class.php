<?php
/**
 * 会员注册
 */
namespace User\Controller;
use Common\Controller\HomeBaseController;
class RegisterController extends HomeBaseController {
	
	function index(){
	    if(sp_is_user_login()){ //已经登录时直接跳到首页
	        redirect(__ROOT__."/");
	    }else{
            $faculty = M('faculty')->where('parent = 0')->select();
            $org = M('org')->select();
            $this -> assign('org', $org);
	        $this -> assign('faculty', $faculty);
            $this -> display(":register");
	    }
	}
	function majorSelect() {
            if($_GET['pid']){
                $major = M('faculty')->where(array('parent' => $_GET['pid']))->select();
                foreach ($major as $ma) {
                    echo '<option value="'.$ma['fid'].'">'.$ma['fa_name'].'</option>';
                }             
            }else{
                    echo ' ';
                }
    }
	function doregister(){
		if(!sp_check_verify_code()){
    		$this->error("验证码错误！");
    	}
    	
    	$users_model=M("Users");
        $user_infor = M('user_infor');
        $faculty_rel = M('faculty_relationships');
    	$rules = array(
    			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
    			array('terms', 'require', '您未同意服务条款！', 1 ),
    			array('user_number', 'require', '学号不能为空！', 1 ),
                array('user_major', 'require', '专业不能为空！', 1 ),
                array('username', 'require', '姓名不能为空！', 1 ),
    			array('email', 'require', '邮箱不能为空！', 1 ),
    			array('password','require','密码不能为空！',1),
    			array('repassword', 'require', '重复密码不能为空！', 1 ),
    			array('repassword','password','确认密码不正确',0,'confirm'),
    			array('email','email','邮箱格式不正确！',1), // 验证email字段格式是否正确
    			 
    	);
    	if($users_model->validate($rules)->create()===false){
    		$this->error($users_model->getError());
    	}
    	
    	extract($_POST);
    	//用户名需过滤的字符的正则
    	$stripChar = '?<*.>\'"';
    	if(preg_match('/['.$stripChar.']/is', $username)==1){
    		$this->error('用户名中包含'.$stripChar.'等非法字符！');
    	}
    	
    	$banned_usernames=explode(",", sp_get_cmf_settings("banned_usernames"));
    	
    	if(in_array($username, $banned_usernames)){
    		$this->error("此用户名禁止使用！");
    	}
    	
    	if(strlen($password) < 5 || strlen($password) > 20){
    		$this->error("密码长度至少5位，最多20位！");
    	}

        $result = $user_infor->where(array('name'=>$username,'id'=>$user_number))->select();
        $where['user_number']=$user_number;
        $where['username']=$username;
        if (!$result) {
            $this->error('学号或姓名不存在！');
        }else{
        	$ucenter_syn=C("UCENTER_ENABLED");
        	$uc_checkname=1;
        	$uc_checkuser_number=1;
        	if($ucenter_syn){
        		include UC_CLIENT_ROOT."client.php";
        		$uc_checkeuser_number=uc_user_checkuser_number($user_number);
        		$uc_checkusername=uc_user_checkname($username);
        	}
        	$users_model=M("Users");
        	$result = $users_model->where($where)->count();
        	if($result || $uc_checkuser_number<0 && $uc_checkusername<0){
        		$this->error("该用户已注册！");
        	}else{
        		$uc_register=true;
        		if($ucenter_syn){
        	
        			$uc_uid=uc_user_register($user_number,$password,$email);
        			//exit($uc_uid);
        			if($uc_uid<0){
        				$uc_register=false;
        			}
        		}
        		if($uc_register){
        			$need_email_active=C("SP_MEMBER_EMAIL_ACTIVE");
        			$data=array(
    					'user_number' => $user_number,
    					'user_email' => $email,
    					'username' =>$username,
                        'user_major'=>$user_major,
    					'user_pass' => sp_password($password),
    					'last_login_ip' => get_client_ip(),
    					'create_time' => date("Y-m-d H:i:s"),
    					'last_login_time' => date("Y-m-d H:i:s"),
    					'user_status' => $need_email_active?2:1,
    					"user_type"=>2,
        			);
        			$rst = $users_model->add($data);
        			if($rst){
                        M('org_relationships')->add(array('oid'=>$org,'uid'=>$rst));
                        $faculty_rel->add(array('user_id'=>$rst,'major_id'=>$_POST['user_major'],'faculty_id'=>$_POST['user_faculty']));
        				//登入成功页面跳转
        				$data['id']=$rst;
        				$_SESSION['user']=$data;

        					
        				//发送激活邮件
        				if($need_email_active){
        					$this->_send_to_active();
        					unset($_SESSION['user']);
        					$this->success("注册成功，激活后才能使用！",U("user/login/index"));
        				}else {
        					$this->success("注册成功！",__ROOT__."/");
        				}
        					
        			}else{
        				$this->error("注册失败！",U("user/register/index"));
        			}
        	
        		}else{
        			$this->error("注册失败！",U("user/register/index"));
        		}
        	
        	}
    	 }
    
	}
	
	
	function active(){
		$hash=I("get.hash","");
		if(empty($hash)){
			$this->error("激活码不存在");
		}
		
		$users_model=M("Users");
		$find_user=$users_model->where(array("user_activation_key"=>$hash))->find();
		
		if($find_user){
			$result=$users_model->where(array("user_activation_key"=>$hash))->save(array("user_activation_key"=>"","user_status"=>1));
			
			if($result){
				$find_user['user_status']=1;
				$_SESSION['user']=$find_user;
				$this->success("用户激活成功，正在登录中...",__ROOT__."/");
			}else{
				$this->error("用户激活失败!",U("user/login/index"));
			}
		}else{
			$this->error("用户激活失败，激活码无效！",U("user/login/index"));
		}
		
		
	}
	
	
}