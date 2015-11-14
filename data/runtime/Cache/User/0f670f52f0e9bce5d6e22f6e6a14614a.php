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
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a>本站用户</a></li>
		</ul>
		<form method="post" class="J_ajaxForm" action="#">
			<div class="table_list">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th align='center'>学号</th>
							<th>姓名</th>
							<th>学院</th>
							<th>专业</th>
							<th>所在组织</th>
							<th>志愿服务活动总时长</th>
						</tr>
					</thead>
					<tbody>
						<?php $user_statuses=array("0"=>"已拉黑","1"=>"正常","2"=>"未验证"); ?>
						<?php if(is_array($lists)): foreach($lists as $key=>$vo): ?><tr>
							<td align='center'><?php echo ($vo["user_number"]); ?></td>
							<!-- <td><img width="25" height="25" src="<?php echo U('user/public/avatar',array('id'=>$vo['id']));?>" /></td>
			                <?php if(empty($vo['user_nicename'])): ?>-->
							  <td><a href="<?php echo U('User/Indexadmin/record',array('id'=>$vo['id']));?>"><?php echo ($vo["username"]); ?></a> </td>
			                <?php else: ?> 
							  <td><a href=""><?php echo ($vo["user_faculty"]); ?></a> </td><?php endif; ?>
							<td><?php echo ($vo["user_org"]); ?></td>
							<td><?php echo ($vo["duration"]); ?></td>
							<td></td>
							<td><?php echo ($user_statuses[$vo['user_status']]); ?></td>
							<td align='center'>
								<a href="<?php echo U('indexadmin/ban',array('id'=>$vo['id']));?>" class="J_ajax_dialog_btn" data-msg="您确定要拉黑此用户吗？">拉黑</a>|
								<a href="<?php echo U('indexadmin/cancelban',array('id'=>$vo['id']));?>" class="J_ajax_dialog_btn" data-msg="您确定要启用此用户吗？">启用</a>
							</td>
						</tr><?php endforeach; endif; ?>
					</tbody>
				</table>
				<div class="pagination"><?php echo ($page); ?></div>
			</div>
		</form>
	</div>
	<script src="/thcmf/statics/js/common.js"></script>
</body>
</html>