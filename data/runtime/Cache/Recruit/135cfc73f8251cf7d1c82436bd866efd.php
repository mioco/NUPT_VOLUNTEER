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
	   <li class="active"><a href="<?php echo U('Recruitadmin/index');?>">项目列表</a></li>
	</ul>
			<form method="post" style="float:right;">
				 <input type="text" placeholder="Search" value="">
				 <input type="submit" class="btn" value="搜索">
			</form>
	<form class="J_ajaxForm" action="" method="post">
		<div class="table-actions">
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Recruitadmin/check',array('check'=>1));?>" data-subcheck="true">审核</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Recruitadmin/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Recruitadmin/active_status',array('active_start'=>1));?>" data-subcheck="true">开始活动</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Recruitadmin/active_status',array('active_end'=>1));?>" data-subcheck="true">结束活动</button>
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo u('Recruitadmin/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
		</div>
		<table class="table table-hover table-bordered table-list">
			<thead>
				<tr>
					<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
					<th width="30">ID</th>
					<th width="100">项目名称</th>
					<th width="30">发布组织</th>
					<th width="70">参与人数</th>
					<th width="70">未审核人数</th>
					<th width="80">活动时间</th>
					<th width="30">活动状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<?php $status=array("2" => "已结束","1"=>"进行中","0"=>"招募中"); dump($article); ?>
			<?php if(is_array($article)): foreach($article as $key=>$vo): ?><tr>
				<td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo ($vo["id"]); ?>" ></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["post_title"]); ?></td>
				<td><a href=""><?php echo ($vo["user_number"]); ?></a></td>
				<td><a href="<?php echo U('Recruitadmin/member',array('id'=>$vo['tid']));?>"><?php echo ($vo["recruit_count"]); ?></a></td>
				<td><a href="<?php echo U('Recruitadmin/not_check',array('id'=>$vo['tid']));?>"><?php echo ($vo["un_check"]); ?></a></td>
				<td><?php echo ($vo["ac_start"]); ?>到<?php echo ($vo["ac_end"]); ?></td>
				<td><?php echo ($status[$vo['active_status']]); ?></td>
				<td>
					<a href="<?php echo U('Recruitadmin/delete',array('tid'=>$vo['tid']));?>" class="J_ajax_del btn" >删除</a>
					<a href="<?php echo u('Recruitadmin/active_status',array('active_start'=>1,'id'=>$vo['id']));?>" class="btn J_ajax_submit_btn" >开始活动</a>
					<a class="btn J_ajax_submit_btn" data-toggle="modal" data-target=".endBox">结束活动</a>
					<div class="modal fade endBox" tabindex="-1" role="dialog">
					  	<div class="modal-body">
				            <label for="recipient-name" class="control-label">提供时长:</label>
				            <input type="text" class="form-control" name="takeTime" value="<?php echo ($vo["duration"]); ?>">
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				          <a href="<?php echo u('Recruitadmin/active_status',array('active_end'=>1,'id'=>$vo['id'],'status'=>$vo['active_status']));?>" type="submit" class="btn btn-primary tk-submit">确定</a>
				        </div>
					</div>
				</td>
			</tr><?php endforeach; endif; ?>
		</table>
		<div class="pagination"><?php echo ($Page); ?></div>
	</form>

</div>
<script src="/thcmf/statics/js/common.js"></script>
<script type="text/javascript">
	$(function() {
		$('.tk-submit').on('click', function(){
			var tk = $('input[name=takeTime]').val();
			console.log($(this).attr('href'));
			$(this).attr('href', $(this).attr('href') + '&duration=' + tk);
			console.log($(this).attr('href'));
		})
	})
</script>
</body>
</html>