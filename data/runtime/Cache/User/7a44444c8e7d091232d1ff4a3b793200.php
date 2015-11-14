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
			<li><a href="<?php echo U('User/Indexadmin/index');?>">本站用户</a></li>
			<li class="active"><a><?php echo ($userInfo['username']); ?></a></li>
		</ul>
		<form method="post" class="J_ajaxForm" action="#">
			<div class="table_list">
				<table class="table table-hover table-bordered">
				<caption><h2 style="margin-bottom:0;">南京邮电大学</h2></caption> 
				<caption><h2>志愿者个人服务记录表</h2></caption>
				<tr>
					<th>姓名</th>
					<td><?php echo ($userInfo['username']); ?></td>
					<th>性别</th>
					<td><?php echo ($userInfo['sex']); ?></td>
					<th>学号</th>
					<td><?php echo ($userInfo['user_number']); ?></td>
				</tr>
				<tr>
					<th>出生年月</th>
					<td><?php echo ($userInfor['birthday']); ?></td>
					<th>学院</th>
					<td><?php echo ($userInfo['faculty']); ?></td>
					<th>专业</th>
					<td><?php echo ($userInfo['major']); ?></td>
				</tr>
				<tr><th colspan="6"><h3>服务记录</h3></th></tr>
				<?php if(is_array($record)): foreach($record as $key=>$re): ?><tr>
					<th colspan="2">活动名称</th>
					<td colspan="4"><?php echo ($re["post_title"]); ?></td>
				</tr>
				<tr>
					<th colspan="2">活动时间</th>
					<th colspan="2">活动地点</th>
					<th colspan="2">活动时长</th>
				</tr>
				<tr>
					<td colspan="2"><?php echo ($re["ac_start"]); ?>到<?php echo ($re["ac_end"]); ?></td>
					<td colspan="2"><?php echo ($re["post_address"]); ?></td>
					<td colspan="2"><?php echo ($re["duration"]); ?></td>
				</tr><?php endforeach; endif; ?>
				<tr>
					<th>共计时长</th>
					<td colspan="5"><?php echo ($userInfo['duration']); ?></td>
				</tr>
				<tr>		
					<th>校团委意见</th>
					<td colspan="2"></td>
					<th>校团委盖章</th>
					<td colspan="2"></td>
				</tr>
			</table>
				<div class="pagination"><?php echo ($page); ?></div>
			</div>
		</form>
        <form action="/thcmf/simplewind/Core/Library/Vendor/printExcel.php" method="post">
        	<input type="hidden" name="username" value="<?php echo ($userInfo['username']); ?>">
        	<input type="hidden" name="table" id="table">
        	<script type="text/javascript">
        	  var td = document.getElementsByTagName("td"),
        	      table = document.getElementById('table'),
        	      inner = '';
        	      for (var i = td.length - 1; i >= 0; i--) {
        	      	inner = td[i].innerText + ',' + inner;
        	      };
        	      table.value = inner;
        	      console.log(td);
        	</script>
        	<input type="submit" value="导出excel">
        </form>
	</div>

	</div>
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
    <script src="/thcmf/tpl_admin/simpleboot/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script src="/thcmf/statics/js/frontend.js"></script>
	<script>
	$(function(){
		$('body').on('touchstart.dropdown', '.dropdown-menu', function (e) { e.stopPropagation(); });
		
		$("#main-menu li.dropdown").hover(function(){
			$(this).addClass("open");
		},function(){
			$(this).removeClass("open");
		});
		
		$.post("<?php echo U('user/index/is_login');?>",{},function(data){
			if(data.status==1){
				if(data.user.avatar){
					$("#main-menu-user .headicon").attr("src",data.user.avatar.indexOf("http")==0?data.user.avatar:"/thcmf/data/upload/avatar/"+data.user.avatar);
				}
				
				$("#main-menu-user .user-nicename").text(data.user.user_nicename!=""?data.user.user_nicename:data.user.user_login);
				$("#main-menu-user li.user.login").show();
				
			}
			if(data.status==0){
				$("#main-menu-user li.user.offline").show();
			}
			
		});	
		;(function($){
			$.fn.totop=function(opt){
				var scrolling=false;
				return this.each(function(){
					var $this=$(this);
					$(window).scroll(function(){
						if(!scrolling){
							var sd=$(window).scrollTop();
							if(sd>100){
								$this.fadeIn();
							}else{
								$this.fadeOut();
							}
						}
					});
					
					$this.click(function(){
						scrolling=true;
						$('html, body').animate({
							scrollTop : 0
						}, 500,function(){
							scrolling=false;
							$this.fadeOut();
						});
					});
				});
			};
		})(jQuery); 
		
		$("#backtotop").totop();
		
		//--------------------------
		//article
		$('.active-comment').click(function() {
			$('.article-box').css("display", "none");
			$('.article-comment').css("display", "inline");
			$('.active-comment').addClass("active");
			$('.active-detail').removeClass("active");
		});
		$('.active-detail').click(function() {
			$('.article-comment').css("display", "none");
			$('.article-box').css("display", "block");
			$('.active-detail').addClass("active");
			$('.active-comment').removeClass("active");
		});

		  // ------------------------
		  //注册时院系选择
		  $('.faculty').on("change", function() {
		  	var pid = $(this).val();
		  	$.ajax({
		  		url: "<?php echo U('user/register/majorSelect');?>",
		  		data: '&pid='+pid,
		  		type: 'get',
		  		success: function(data) {
		  			$('.major').html(data);
		  		}
		  	})
		  
		  })
		  //------------------------
		  //list多条件选项
		  

	});
	</script>


</body>
</html>