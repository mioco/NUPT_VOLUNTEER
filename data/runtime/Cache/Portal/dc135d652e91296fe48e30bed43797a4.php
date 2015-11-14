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
     <li class="active"><a href="<?php echo U('AdminPage/index');?>">所有页面</a></li>
     <li><a href="<?php echo U('AdminPage/add');?>">添加页面</a></li>
  </ul>
  <form class="well form-search" method="post" action="<?php echo u('AdminPage/index');?>">
    <div class="search_type cc mb10">
      <div class="mb10"> 
        <span class="mr20">时间：
        <input type="text" name="start_time" class="input length_2 J_date" value="<?php echo ($formget["start_time"]); ?>" style="width:80px;" autocomplete="off">-<input autocomplete="off" type="text" class="input length_2 J_date" name="end_time" value="<?php echo ($formget["end_time"]); ?>" style="width:80px;">
        <!-- 
        <select class="select_2" name="posids"style="width:70px;">
          <option value='' selected>全部</option>
        </select>
        <select class="select_2" name="searchtype" style="width:70px;">
          <option value='0' >标题</option>
        </select>
         -->
                           关键字：
        <input type="text" class="input length_2" name="keyword" style="width:200px;" value="<?php echo ($formget["keyword"]); ?>" placeholder="请输入关键字...">
        <button class="btn btn-primary">搜索</button>
        </span>
      </div>
    </div>
  </form>
  <form class="J_ajaxForm" action="" method="post">
  		<div class="table-actions">
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPage/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
		</div>
      <table class="table table-hover table-bordered table-list">
        <thead>
	          <tr>
	            <th width="16"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
	            <th width="100">ID</th>
	            <th>标题</th>
	            <!-- <th>点击量</th> -->
	            <th width="80">发布人</th>
	            <th width="120"><span>发布时间</span></th>
	            <th width="120">操作</th>
	          </tr>
	    </thead>
        	<?php if(is_array($posts)): foreach($posts as $key=>$vo): ?><tr>
		            <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo ($vo["id"]); ?>"></td>
		            <td><a><?php echo ($vo["id"]); ?></a></td>
		            <td>
		            	<a href="<?php echo U('portal/page/index',array('id'=>$vo['id']));?>" target="_blank"><span><?php echo ($vo["post_title"]); ?></span></a>
		            </td>
		           <!--  <td>0</td> -->
		            <td><?php echo ($users[$vo['post_author']]['user_login']); ?></td>
		            <td><?php echo ($vo["post_date"]); ?></td>
		            <td>
		            	<a href="<?php echo U('AdminPage/edit',array('id'=>$vo['id']));?>">修改</a>|
		            	<a href="<?php echo U('AdminPage/delete',array('id'=>$vo['id']));?>" class="J_ajax_del" >删除</a>
					</td>
	          	</tr><?php endforeach; endif; ?>
          	<tfoot>
	          <tr>
	            <th width="16"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
	            <th width="100">ID</th>
	            <th>标题</th>
	            <!-- <th>点击量</th> -->
	            <th width="80">发布人</th>
	            <th width="120"><span>发布时间</span></th>
	            <th width="120">操作</th>
	          </tr>
		    </tfoot>
          </table>
          <div class="table-actions">
			<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPage/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
		</div>
      		<div class="pagination"><?php echo ($Page); ?></div>
  </form>
</div>
<script src="/thcmf/statics/js/common.js"></script>
<script>
setCookie('refersh_time', 0);
function refersh_window() {
    var refersh_time = getCookie('refersh_time');
    if (refersh_time == 1) {
        window.location.reload();
    }
}
setInterval(function(){
	refersh_window()
}, 2000);

</script>
</body>
</html>