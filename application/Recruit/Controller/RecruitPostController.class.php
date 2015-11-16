<?php
namespace Recruit\Controller;
use Common\Controller\MemberbaseController;
class RecruitPostController extends MemberbaseController{
	
	protected $comments_model;
	protected $join_model;
	
	function _initialize() {
		parent::_initialize();
		$this->comments_model=D("Common/Comments");
	}
	
	function post(){
		/* if($_SESSION['_verify_']['verify']!=I("post.verify")){
			$this->error("验证码错误！");
		} */
		
		if (IS_POST){			
			$_POST['createtime']=date('Y-m-d');
			if(isset($_SESSION["user"])){//用户已登陆,且是本站会员
				$uid=$_SESSION["user"]['id'];
				$where['uid'] = $uid;
				$where['tid'] = $_GET['tid'];
				var_dump($where);
				die();
				$check = $this->recruit_model->where($where)->find();
				if ($check) {
					echo"<script>alert('您已经报名，请耐心等待审核。');history.go(-1);</script>";
				}else{
					echo"<script>alert('报名成功。');history.go(-1);</script>";
					$_POST['uid']=$uid;
					if(C("JOIN_NEED_CHECK")){
						$_POST['status']=1;//评论审核功能开启
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
				}
			}
		}
	}	
}