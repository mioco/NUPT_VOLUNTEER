<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title><?php echo ($site_name); ?></title>
<meta name="keywords" content="<?php echo ($site_seo_keywords); ?>" />
<meta name="description" content="<?php echo ($site_seo_description); ?>">
<meta name="author" content="ThinkCMF">
	<?php  function _sp_helloworld(){ echo "hello ThinkCMF!"; } function _sp_helloworld2(){ echo "hello ThinkCMF2!"; } function _sp_helloworld3(){ echo "hello ThinkCMF3!"; } ?>
	<?php $portal_index_lastnews=2; $portal_hot_articles="1,2"; $portal_last_post="1,2"; $tmpl=sp_get_theme_path(); $default_home_slides=array( array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/1.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/2.jpg", "slide_url"=>"", ), array( "slide_name"=>"ThinkCMFX1.6.0发布啦！", "slide_pic"=>$tmpl."Public/images/demo/3.jpg", "slide_url"=>"", ), ); ?>
	<meta name="author" content="ThinkCMF">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">

   	<!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
	<link rel="icon" href="/thcmf/tpl/simplebootx/Public/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/thcmf/tpl/simplebootx/Public/images/favicon.ico" type="image/x-icon">
    <link href="/thcmf/tpl/simplebootx/Public/simpleboot/themes/cmf/theme.min.css" rel="stylesheet">
    <link href="/thcmf/tpl/simplebootx/Public/simpleboot/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/thcmf/tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
	<!--[if IE 7]>
	<link rel="stylesheet" href="/thcmf/tpl/simplebootx/Public/simpleboot/font-awesome/4.2.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<link href="/thcmf/tpl/simplebootx/Public/css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/thcmf/tpl/simplebootx/Public/css/index.css">
	<style>
		/*html{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}*/
		#backtotop{position: fixed;bottom: 50px;right:20px;display: none;cursor: pointer;font-size: 50px;z-index: 9999;}
		#backtotop:hover{color:#333}
		#main-menu-user li.user{display: none}
	</style>
	
</head>

<body class="body-white">
	<?php echo hook('body_start');?>
<div class="navbar">
	<div class="top-nav" style="height:37px;">
	<div class="pull-right">
		<tbody>
		<ul>
			<?php  $ch = curl_init(); $url = 'http://apis.baidu.com/apistore/weatherservice/cityname?cityname=南京'; $header = array( 'apikey: f0ed1939d17a61979cd5b0a1bdd20fc7', ); curl_setopt($ch, CURLOPT_HTTPHEADER , $header); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch , CURLOPT_URL , $url); $res = curl_exec($ch); $res = json_decode($res,true); $res = $res['retData']; switch ($da = date('w')) { case '1': $da = "星期一"; break; case '2': $da = "星期二"; break; case '3': $da = "星期三"; break; case '4': $da = "星期四"; break; case '5': $da = "星期五"; break; case '6': $da = "星期六"; break; case '0': $da = "星期日"; break; } echo '<li>'.$res['date'].'-'.$da.'</li>'; echo '<li>'.$res['weather'].'</li>'; echo '<li>'.$res['l_tmp'].'~'.$res['h_tmp'].'℃</li>'; ?>
			<li>
				<ul class="nav pull-right" id="main-menu-user">
					<li class="dropdown user login">
			            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
			            <img src="/thcmf/tpl/simplebootx//Public/images/headicon.png" class="headicon"/>
			            <span class="user-nicename"></span><b class="caret"></b></a>
			            <ul class="dropdown-menu pull-right">
			               <li><a href="<?php echo u('user/center/index');?>"><i class="iconfont">&#xe60f</i> &nbsp;个人中心</a></li>
			               <li class="divider"></li>
			               <li><a href="<?php echo u('user/index/logout');?>"><i class="iconfont">&#xe60d</i> &nbsp;退出</a></li>
			            </ul>
		          	</li>
		          	<li class="dropdown user offline">
			            <ul class="pull-right">
			               <li><a href="<?php echo u('user/login/index');?>"><i class="iconfont">&#xe609</i>登录</a></li>
			               <li><a href="<?php echo u('user/register/index');?>"><i class="iconfont">&#xe60e</i>注册</a></li>
			            </ul>
		          	</li>
				</ul></li>
			<li>
				<form method="post" class="form-inline" action="<?php echo U('portal/search/index');?>">
					 <input type="text" class="" placeholder="Search" name="keyword" value="<?php echo I('get.keyword');?>"/>
					 <button type="submit" class="btn btn-info"><i class="iconfont">&#xe601</i></button>
				</form></li>
			</ul>
		</tbody> 
	</div>
	</div>
   <div class="navbarInner">   	
       <div class="nav-container">
       <!-- <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </a> -->
       <a class="brand" href="/thcmf/"><img src="/thcmf/tpl/simplebootx/Public/images/logo.png"/></a>
       <div class="pull-right" id="main-menu">
       	<?php
 $effected_id="menu"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label <b class='caret'></b></a>"; $ul_class="dropdown-menu" ; $li_class="menu-item" ; $style="nav"; $showlevel=6; $dropdown='dropdown'; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>		
       </div>
   </div>
   </div>
 </div>


	<div class="container tc-main">
		<div class="row">
			<div class="span6 offset3">
				<h2 class="text-center">创建账号</h2>
				<form class="form-horizontal J_ajaxForm" action="<?php echo U('user/register/doregister');?>" method="post">
					<div class="control-group">
						<label class="control-label" for="input_number">学号</label>
						<div class="controls">
							<input type="text" id="input_number" name="user_number" placeholder="请输入你的学号" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_carnumber">校园卡号</label>
						<div class="controls">
							<input type="text" id="input_carnumber" name="user_carnumber" placeholder="请输入你的校园卡号" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="username">姓名</label>
						<div class="controls">
							<input type="text" id="username" name="username" placeholder="请输入你的姓名" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_email">联系方式</label>
						<div class="controls">
							<input type="text" id="input_email" name="email" placeholder="请输入邮箱" class="span3">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input_faculty">学院</label>
						<select class="controls faculty" name="user_faculty">
							<option value="0">---选择学院---</option>
							<?php if(is_array($faculty)): foreach($faculty as $key=>$fa): ?><option value="<?php echo ($fa["fid"]); ?>"><?php echo ($fa["fa_name"]); ?></option><?php endforeach; endif; ?>
						</select>
						<select class="major" name="user_major">
							<?php echo ($major); ?>
						</select>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_password">密码</label>
						<div class="controls">
							<input type="password" id="input_password" name="password" placeholder="请输入密码" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword">重复密码</label>
						<div class="controls">
							<input type="password" id="input_repassword" name="repassword" placeholder="请输入重复密码" class="span3">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_verify">验证码</label>
						<div class="controls">
							<input type="text" id="input_verify" name="verify" placeholder="请输入验证码" class="span3">
							<?php echo sp_verifycode_img('code_len=4&font_size=15&width=100&height=35&charset=1234567890');?>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<label class="checkbox persistent"><input type="checkbox" name="terms" value="1">
								我同意<a href="#">网站内容服务条款</a></label>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<button class="btn btn-primary J_ajax_submit_btn" type="submit" data-wait="1500">确定注册</button>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="input_repassword"></label>
						<div class="controls">
							<p>
								已有账号? <a href="<?php echo U('user/login/index');?>">点击此处登录</a>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>

		<br><br><br>
<!-- Footer
      ================================================== -->
<?php echo hook('footer');?>

      <div id="footer" style="height:90px;">
        <div class="links">
        <?php $links=sp_getlinks(); ?>
        <?php if(is_array($links)): foreach($links as $key=>$vo): ?><a href="<?php echo ($vo["link_url"]); ?>" target="<?php echo ($vo["link_target"]); ?>"><?php echo ($vo["link_name"]); ?></a><?php endforeach; endif; ?>
        </div>
        <p>
        Copyright©2015 NUPT Young Volunteers Association
        </p>
      </div>
      <div id="backtotop"><i class="fa fa-arrow-circle-up"></i></div>
      <?php echo ($site_tongji); ?>


	</div>
	<!-- /container -->

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
    <script src="/thcmf/tpl/simplebootx/Public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
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