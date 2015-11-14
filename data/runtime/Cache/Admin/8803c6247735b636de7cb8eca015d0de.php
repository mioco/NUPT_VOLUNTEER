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
<style>
.home_info li em {
float: left;
width: 100px;
font-style: normal;
}
li {
list-style: none;
}

</style>
</head>

<body>
<div class="wrap">
  <div id="home_toptip"></div>
  <h4 class="well">管理员公告</h4>
  <div class="home_info">
  </div>
  <h4 class="well">消息通知</h4>
  <div class="home_info">
    <div class="not_check">
    <strong>未审核报名：&nbsp;</strong>
    <a href="<?php echo u('Recruit/Recruitadmin/not_check');?>"><?php echo ($count); ?></a></div>
  </div>
</div>
<script src="/thcmf/statics/js/common.js"></script> 
<script>
//获取官方通知
// $.getJSON("http://www.thinkcmf.com/service/sms_jsonp.php?callback=?",function(data){
// 	var tpl='<li><em class="title"></em><span class="content"></span></li>';
// 	var $thinkcmf_notices=$("#thinkcmf_notices");
// 	$thinkcmf_notices.empty();
// 	if(data.length>0){
// 		$.each(data,function(i,n){
// 			var $tpl=$(tpl);
// 			$(".title",$tpl).html(n.title);
// 			$(".content",$tpl).html(n.content);
// 			$thinkcmf_notices.append($tpl);
// 		});
// 	}else{
// 		$thinkcmf_notices.append("<li>^_^,没有通知~~</li>");
// 	}
	
// });
</script>
</body>
</html>