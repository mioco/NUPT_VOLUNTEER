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
<body class="J_scroll_fixed" style="min-width:800px;">
<div class="wrap J_check_wrap">
	<ul class="nav nav-tabs">
	   <li class="active"><a href="<?php echo U('commentadmin/index');?>">所有评论</a></li>
	</ul>
	<form class="J_ajaxForm" action="" method="post">
		<div class="table-actions">
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Commentadmin/check',array('check'=>1));?>" data-subcheck="true">审核</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Commentadmin/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Commentadmin/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
		</div>
		<table class="table table-hover table-bordered table-list">
			<thead>
				<tr>
					<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
					<th width="50">ID</th>
					<th width="100">用户名/姓名</th>
					<th width="150">邮箱</th>
					<th>内容</th>
					<th width="120">评论时间</th>
					<th width="50">状态</th>
					<th width="50">操作</th>
				</tr>
			</thead>
			<?php $status=array("1"=>"已审核","0"=>"未审核"); ?>
			<?php if(is_array($comments)): foreach($comments as $key=>$vo): ?><tr>
				<td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo ($vo["id"]); ?>" ></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["full_name"]); ?></td>
				<td><?php echo ($vo["email"]); ?></td>
				<td><?php echo ($vo["content"]); ?></td>
				<td><?php echo ($vo["createtime"]); ?></td>
				<td><?php echo ($status[$vo['status']]); ?></td>
				<td>
					<a href="<?php echo U('Commentadmin/delete',array('id'=>$vo['id']));?>" class="J_ajax_del" >删除</a>
				</td>
			</tr><?php endforeach; endif; ?>
		    <tfoot>
				<tr>
					<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
					<th width="50">ID</th>
					<th width="100">用户名/姓名</th>
					<th width="150">邮箱</th>
					<th>内容</th>
					<th width="120">评论时间</th>
					<th width="50">状态</th>
					<th width="50">操作</th>
				</tr>
			</tfoot>
		</table>
		<div class="table-actions">
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Commentadmin/check',array('check'=>1));?>" data-subcheck="true">审核</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Commentadmin/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Commentadmin/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
		</div>
		<div class="pagination"><?php echo ($Page); ?></div>
	</form>
</div>
<script src="/thcmf/statics/js/common.js"></script>
</body>
</html>