<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/thcmf/statics/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/thcmf/statics/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/thcmf/statics/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/thcmf/statics/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/thcmf/statics/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/thcmf/",
    JS_ROOT: "statics/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/thcmf/statics/js/jquery.js"></script>
    <script src="/thcmf/statics/js/wind.js"></script>
    <script src="/thcmf/statics/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body class="J_scroll_fixed">
	<div class="wrap jj">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('user/index');?>">管理员</a></li>
			<li class="active"><a href="<?php echo U('user/add');?>">添加管理员</a></li>
		</ul>
		<div class="common-form">
			<form method="post" class="form-horizontal J_ajaxForm" action="<?php echo U('User/add_post');?>">
				<fieldset>
					<div class="control-group">
						<label class="control-label">用户名:</label>
						<div class="controls">
							<input type="text" class="input" name="user_number" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">密码:</label>
						<div class="controls">
							<input type="password" class="input" name="user_pass" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">邮箱:</label>
						<div class="controls">
							<input type="text" class="input" name="user_email" value="">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">角色:</label>
						<div class="controls">
							<?php if(is_array($roles)): foreach($roles as $key=>$vo): ?><label class="checkbox inline"><input value="<?php echo ($vo["id"]); ?>" type="checkbox" name="role_id[]"><?php echo ($vo["name"]); ?></label><?php endforeach; endif; ?>
						</div>
					</div>
				</fieldset>
				<div class="form-actions">
					<button type="submit"
						class="btn btn-primary btn_submit J_ajax_submit_btn">添加</button>
					<a class="btn" href="/thcmf/index.php/Admin/User">返回</a>
				</div>
			</form>
		</div>
	</div>
	<script src="/thcmf/statics/js/common.js"></script>
</body>
</html>