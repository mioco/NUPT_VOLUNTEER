<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>系统后台</title>
		<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge" />
		<meta name="renderer" content="webkit|ie-comp|ie-stand">
		<meta name="robots" content="noindex,nofollow">
		<link href="/thcmf/tpl_admin/simpleboot/assets/css/admin_login.css" rel="stylesheet" />
		<script>
			if (window.parent !== window.self) {
					document.write = '';
					window.parent.location.href = window.self.location.href;
					setTimeout(function () {
							document.body.innerHTML = '';
					}, 0);
			}
		</script>
		
	</head>
<body>
	<div class="wrap">
		<h1>南邮青协志愿系统</h1>
		<form method="post" name="login" action="<?php echo U('public/dologin');?>" autoComplete="off" class="J_ajaxForm">
			<div class="login">
				<ul>
					<li>
						<input class="input" id="J_admin_name" required name="user_number" type="text" placeholder="管理名" title="管理名" value="<?php echo ($_COOKIE['admin_username']); ?>"/>
					</li>
					<li>
						<input class="input" id="admin_pwd" type="password" required name="password" placeholder="密码" title="密码" />
					</li>
					<li>
						<div id="J_verify_code">
							<?php echo sp_verifycode_img('length=4&font_size=25&width=238&height=50','style="cursor: pointer;" title="点击获取"');?>
						</div>
					</li>
					<li>
						<input class="input" type="text" name="verify" placeholder="请输入验证码" />
					</li>
				</ul>
				<div id="login_btn_wraper">
					<button type="submit" name="submit" class="btn btn_submit J_ajax_submit_btn">登录</button>
				</div>
			</div>
		</form>
	</div>

<script>
var GV = {
	DIMAUB: "/thcmf/",
	JS_ROOT: "statics/js/",//js版本号
	TOKEN : ''	//token ajax全局
};
</script>
<script src="/thcmf/statics/js/wind.js"></script>
<script src="/thcmf/statics/js/jquery.js"></script>
<script type="text/javascript" src="/thcmf/statics/js/common.js"></script>
<script>
;(function(){
	document.getElementById('J_admin_name').focus();
	
})();
</script>
</body>
</html>