<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($name); ?> <?php echo ($seo_title); ?> <?php echo ($site_name); ?></title>
	<meta name="keywords" content="<?php echo ($seo_keywords); ?>" />
	<meta name="description" content="<?php echo ($seo_description); ?>">
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
<body>
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

<div class="container tc-main">
	
	
    <div class="pg-opt pin">
        <div class="container">
            <h2><?php echo ($name); ?></h2>
        </div>
    </div>
    <div class="row">
		<div class="span9">
			<div class="">
				<?php $lists = sp_sql_posts_paged("cid:$cat_id;order:post_date DESC;",10); ?>
				<?php if(is_array($lists['posts'])): $i = 0; $__LIST__ = $lists['posts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $smeta=json_decode($vo['smeta'], true); ?>
				
				<div class="list-boxes">
					<h2><a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>"><?php echo ($vo["post_title"]); ?></a></h2>
					<p><?php echo (msubstr($vo["post_excerpt"],0,256)); ?></p>
					<div>
						<div class="pull-left">
							<div class="list-actions">
							<a href="javascript:;"><i class="fa fa-eye"></i><span><?php echo ($vo["post_hits"]); ?></span></a>
							<a href="<?php echo U('article/do_like',array('id'=>$vo['object_id']));?>" class="J_count_btn"><i class="fa fa-thumbs-up"></i><span class="count"><?php echo ($vo["post_like"]); ?></span></a>
							<a href="<?php echo U('user/favorite/do_favorite',array('id'=>$vo['object_id']));?>" class="J_favorite_btn" data-title="<?php echo ($vo["post_title"]); ?>" data-url="<?php echo U('portal/article/index',array('id'=>$vo['tid']));?>" data-key="<?php echo sp_get_favorite_key('posts',$vo['object_id']);?>">
								<i class="fa fa-star-o"></i>
							</a>
							</div>
						</div>
						<a class="btn btn-warning pull-right" href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>">查看更多</a>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
				
			</div>
			<div class="pagination">
				<ul>
					<?php echo ($lists['page']); ?>
				</ul>
			</div>
		</div>
		<div class="span3">
			<div class="tc-box first-box">
			<div class="headtitle">
          		<h2>分享</h2>
          	</div>
			<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tqf" data-cmd="tqf" title="分享到腾讯朋友"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a></div>
			<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"2","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=86835285.js?cdnversion='+~(-new Date()/36e5)];</script>          
        	</div>
        	
        	<div class="tc-box">
	        	<div class="headtitle">
	        		<h2>热门文章</h2>
	        	</div>
	        	<div class="ranking">
	        		<?php $hot_articles=sp_sql_posts("cid:$portal_index_lastnews;field:post_title,post_excerpt,tid,smeta;order:post_hits desc;limit:5;"); ?>
		        	<ul class="unstyled">
		        		<?php if(is_array($hot_articles)): foreach($hot_articles as $key=>$vo): $top=$key<3?"top3":""; ?>
							<li class="<?php echo ($top); ?>"><i><?php echo ($key+1); ?></i><a title="<?php echo ($vo["post_title"]); ?>" href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>"><?php echo ($vo["post_title"]); ?></a></li><?php endforeach; endif; ?>
					</ul>
				</div>
			</div>
			<div class="tc-box">
	        	<div class="headtitle">
	        		<h2>最新评论</h2>
	        	</div>
	        	<div class="comment-ranking">
	        		<?php $last_comments=sp_get_comments("field:*;limit:0,5;order:createtime desc;"); ?>
	        		<?php if(is_array($last_comments)): foreach($last_comments as $key=>$vo): ?><div class="comment-ranking-inner">
	                        <i class="fa fa-comment"></i>
	                        <a href="<?php echo U('user/index/index',array('id'=>$vo['uid']));?>"><?php echo ($vo["full_name"]); ?>:</a>
	                        <span><?php echo ($vo["content"]); ?></span>
	                        <a href="/thcmf/<?php echo ($vo["url"]); ?>#comment<?php echo ($vo["id"]); ?>">查看原文</a>
	                        <span class="comment-time"><?php echo date('m月d日  H:i',strtotime($vo['createtime']));?></span>
	                    </div><?php endforeach; endif; ?>
                </div>
			</div>
			
			<div class="tc-box">
	        	<div class="headtitle">
	        		<h2>最新加入</h2>
	        	</div>
	        	<?php $last_users=sp_get_users("field:*;limit:0,8;order:create_time desc;"); ?>
	        	<ul class="list-unstyled tc-photos margin-bottom-30">
	        		<?php if(is_array($last_users)): foreach($last_users as $key=>$vo): ?><li>
	                    <a href="<?php echo U('user/index/index',array('id'=>$vo['id']));?>">
	                    <img alt="" src="<?php echo U('user/public/avatar',array('id'=>$vo['id']));?>">
	                    </a>
                    </li><?php endforeach; endif; ?>
                </ul>
			</div>
			
			<div class="tc-box">
	        	<div class="headtitle">
	        		<h2>最新发布</h2>
	        	</div>
	        	<?php $last_post=sp_sql_posts("cid:$portal_last_post;field:post_title,post_excerpt,tid,smeta;order:listorder asc;limit:4;"); ?>
	        	<div class="posts">
	        		<?php if(is_array($last_post)): foreach($last_post as $key=>$vo): $smeta=json_decode($vo['smeta'],true); ?>
			        	<dl class="dl-horizontal">
				            <dt>
					            <a class="img-wraper" href="<?php echo U('article/index',array('id'=>$vo['tid']));?>">
					            	<?php if(empty($smeta['thumb'])): ?><img src="/thcmf/tpl/simplebootx/Public/images/default_tupian4.png" class="img-responsive" alt="<?php echo ($vo["post_title"]); ?>"/>
									<?php else: ?> 
										<img src="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" class="img-responsive img-thumbnail" alt="<?php echo ($vo["post_title"]); ?>" /><?php endif; ?>
					            </a>
				            </dt>
				            <dd><a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>"><?php echo msubstr($vo['post_excerpt'],0,32);?></a></dd>
				        </dl><?php endforeach; endif; ?>
		        </div>
			</div>
			
			<?php $ad=sp_getad("portal_list_right_aside"); ?>
			<?php if(!empty($ad)): ?><div class="tc-box">
	        	<div class="headtitle">
	        		<h2>赞助商</h2>
	        	</div>
	        	<div>
		        	<?php echo ($ad); ?>
		        </div>
			</div><?php endif; ?>
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

    
<!-- JavaScript -->
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