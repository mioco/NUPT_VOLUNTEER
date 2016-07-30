<?php
namespace Recruit\Controller;
use Common\Controller\HomeBaseController;
class RecruitPostController extends HomeBaseController{
	
	protected $comments_model;
	protected $recruit_model;
	protected $users_model;
	
	function _initialize() {
		parent::_initialize();
		$this->comments_model=D("Common/Comments");
		$this->recruit_model=D("Common/recruit");
		$this->users_model=D("Common/users");
	}
	
	function post(){
		/* if($_SESSION['_verify_']['verify']!=I("post.verify")){
			$this->error("验证码错误！");
		} */
		
		if (IS_POST){			
			$_POST['createtime']=date('Y-m-d');
			if(isset($_SESSION["user"])){//用户已登陆,且是本站会员
				$posts = M('posts');
				$tid=I('param.tid');
				if (!$status = $posts->where(array('id'=>$tid))->getField('active_status')) {
					$uid=$_SESSION["user"]['id'];
					$where['uid'] = $uid;
					$where['tid'] = $_REQUEST['tid'];
					$check = $this->recruit_model->where($where)->find();
					if ($check && $check['status']==0) {
						echo"您已经报名，请耐心等待审核。";
					}elseif($check && $check['status']==1){						
						echo"您已经在活动中。";
					}else{
						$_POST['uid']=$uid;
						if(C("JOIN_NEED_CHECK")){
							$_POST['status']=1;//审核功能开启
						}else{
							$_POST['status']=0;
						}
						if ($this->recruit_model->create()){
							$this->check_last_action(intval(C("JOIN_TIME_INTERVAL")));
							$result=$this->recruit_model->add();
							if (!$result){
								$this->error("报名失败！");
							}
						} else {
							$this->error($this->recruit_model->getError());
						}
						echo"报名成功。";
					}
				}else{
					echo "该活动已结束。";
				}
			}else{
				echo '请登录后再操作。';
			}
		}
	}	
}