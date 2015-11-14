<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
	<html lang="en">
	<head>
		<title>ThinkCMF-跳转提示</title>
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
	
		<style type="text/css">
		*{ padding: 0; margin: 0; }
		body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
		.system-message{ padding: 24px 48px;text-align: center; }
		.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; text-align: center;}
		.system-message .jump{ padding-top: 10px}
		.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
		.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
		</style>
	</head>
<body class="body-white">
	<?php echo hook('body_start');?>
<div class="navbar">
	<div class="top-nav" style="height:37px;">
		<div class="nav-container">
			<div class="img"><img src="/thcmf/tpl/simplebootx//Public/images/head1.png" alt=""></div>
			<ul>
				<?php  $ch = curl_init(); $url = 'http://apis.baidu.com/apistore/weatherservice/cityname?cityname=南京'; $header = array( 'apikey: f0ed1939d17a61979cd5b0a1bdd20fc7', ); curl_setopt($ch, CURLOPT_HTTPHEADER , $header); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch , CURLOPT_URL , $url); $res = curl_exec($ch); $res = json_decode($res,true); $res = $res['retData']; switch ($da = date('w')) { case '1': $da = "星期一"; break; case '2': $da = "星期二"; break; case '3': $da = "星期三"; break; case '4': $da = "星期四"; break; case '5': $da = "星期五"; break; case '6': $da = "星期六"; break; case '0': $da = "星期日"; break; } echo '<li>'.$res['date'].'-'.$da.'</li>'; echo '<li>'.$res['weather'].'</li>'; echo '<li>'.$res['l_tmp'].'~'.$res['h_tmp'].'℃</li>'; ?>
			</ul>
			<form method="post" class="form-inline pull-right" action="<?php echo U('portal/search/index');?>">
				 <input type="text" class="" placeholder="Search" name="keyword" value="<?php echo I('get.keyword');?>"/>
				 <button type="submit"><i class="iconfont">&#xe601</i></button>
			</form>
			<ul class="nav pull-right" id="main-menu-user">
				<li class="dropdown user login">
		            <a class="dropdown-toggle user" data-toggle="dropdown" href="#">
		            	<div class="img"><img src="/thcmf/tpl/simplebootx//Public/images/headicon.png" class="headicon"/></div></a>
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
			</ul>
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

	<div class="system-message">
	<?php if(isset($message)): ?><h1>^_^</h1>
	<p class="success"><?php echo($message); ?></p>
	<?php else: ?>
	<h1>&gt;_&lt;</h1>
	<p class="error"><?php echo($error); ?></p><?php endif; ?>
	<p class="detail"></p>
	<p class="jump">
	ThinkCMF：页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
	</p>
	</div>
	<script type="text/javascript">
	(function(){
	var wait = document.getElementById('wait'),href = document.getElementById('href').href;
	var interval = setInterval(function(){
		var time = --wait.innerHTML;
		if(time <= 0) {
			location.href = href;
			clearInterval(interval);
		};
	}, 1000);
	})();
	</script>

</body>
</html>