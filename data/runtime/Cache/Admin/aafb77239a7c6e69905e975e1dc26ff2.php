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
	<div class="wrap J_check_wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('user/index');?>">管理员</a></li>
			<li><a href="<?php echo U('user/add');?>">添加管理员</a></li>
		</ul>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>管理名</th>
					<th>最后登录IP</th>
					<th>最后登录时间</th>
					<th>E-mail</th>
					<th>状态</th>
					<th width="120">管理操作</th>
				</tr>
			</thead>
			<tbody>
				<?php $user_statuses=array("0"=>"停用","1"=>"启用","2"=>"未验证"); ?>
				<?php if(is_array($users)): foreach($users as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["user_number"]); ?></td>
					<td><?php echo ($vo["last_login_ip"]); ?></td>
					<td>
						<?php if($vo['last_login_time'] == 0): ?>该用户还没登陆过
						<?php else: ?>
							<?php echo ($vo["last_login_time"]); endif; ?>
					</td>
					<td><?php echo ($vo["user_email"]); ?></td>
					<td><?php echo ($user_statuses[$vo['user_status']]); ?></td>
					<td>
						<?php if($vo['id'] == 1): ?><font color="#cccccc">修改</font> | <font color="#cccccc">删除</font> |
							<?php if($vo['user_status'] == 1): ?><font color="#cccccc">停用</font>
							<?php else: ?>
								<font color="#cccccc">启用</font><?php endif; ?>
						<?php else: ?>
							<a href='<?php echo U("user/edit",array("id"=>$vo["id"]));?>'>修改</a> | 
							<a class="J_ajax_del" href="<?php echo U('user/delete',array('id'=>$vo['id']));?>">删除</a> | 
							<?php if($vo['user_status'] == 1): ?><a href="<?php echo U('user/ban',array('id'=>$vo['id']));?>" class="J_ajax_dialog_btn" data-msg="您确定要停用此用户吗？">停用</a>
							<?php else: ?>
								<a href="<?php echo U('user/cancelban',array('id'=>$vo['id']));?>" class="J_ajax_dialog_btn" data-msg="您确定要启用此用户吗？">启用</a><?php endif; endif; ?>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/thcmf/statics/js/common.js"></script>
</body>
</html>