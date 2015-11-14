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
	
    <style type="text/css">
        #menu-item-4{border-bottom: 4px solid #e50007;color: #e50007;}
    </style>
</head>
<body> 

<div class="container">
    <?php $terms = sp_get_child_terms(3); ?>
    <div class="term-bar">
        <div class="time-type">
            <span>时间类型</span>
            <a href="">全部活动</a>
            <a href="">长期活动</a>
            <a href="">临时活动</a>
        </div>
        <div class="term-status">
            <span>服务类型</span>
            <a id="term-item-<?php echo ($te["term_id"]); ?>" href="<?php echo u('list/index?id=3');?>">不限</a>
            <?php if(is_array($terms)): foreach($terms as $key=>$te): ?><a target="main"><span><?php echo ($te["name"]); ?></span></a><?php endforeach; endif; ?>
        </div>
        <div class="time-limit">
            <span>时间限制</span>
            <a href="" value="0" target="main">全周</a>
            <a href="" value="1" target="main">周一</a>
            <a href="" value="2" target="main">周二</a>
            <a href="" value="3" target="main">周三</a>
            <a href="" value="4" target="main">周四</a>
            <a href="" value="5" target="main">周五</a>
            <a href="" value="6" target="main">周六</a>
            <a href="" value="7" target="main">周日</a>
        </div>
        <div class="term-status status-bar">
            <span>活动状态</span>
            <a href="">全部</a>
            <a class="recruiting">招募中</a>
            <a class="underway">进行中</a>
            <a class="over">已结束</a>
        </div>
    </div>
    <?php $date = $_GET['date']; echo $date; $tag = "active_status,post_title,post_address,post_date,ac_start,ac_end,smeta,post_hits,post_like,quality"; $map['quality'] = array('like', '%3,4%'); $posts = D("Common/Posts")->field($tag)->where($map)->select(); dump($posts); ?>
    <div class="row">
        <?php if(is_array($posts['posts'])): $i = 0; $__LIST__ = $posts['posts'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $smeta=json_decode($vo['smeta'],true); ?>
        <div class="post-box">
            <div class="tc-gridbox">
                <div class="header">
                    <div class="item-image">
                        <a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>">
                            <?php if(empty($smeta['thumb'])): ?><img src="/thcmf/tpl/simplebootx/Public/images/default_tupian1.png" class="img-responsive" alt="<?php echo ($vo["post_title"]); ?>"/>
                            <?php else: ?> 
                                <img src="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" class="img-responsive img-thumbnail" alt="<?php echo ($vo["post_title"]); ?>" /><?php endif; ?>
                        </a>
                    </div>
                    <h3><a href="<?php echo leuu('article/index',array('id'=>$vo['tid']));?>"><?php echo ($vo["post_title"]); ?></a></h3>
                </div>
                <div class="body">
                    <p>活动地点：<?php echo ($vo["post_address"]); ?></p>
                    <p>活动发起：<?php echo ($vo["user_login"]); ?></p>
                    <div class="timebox">
                        <div>报名截止：</div>
                        <div class="time"><div class="pass_time" id="<?php echo ($vo["tid"]); ?>" style="width:<?php echo ($vo["time_width"]); ?>%"></div></div>
                        <div class="residue">&nbsp;<?php echo ($vo["residue"]); ?></div>
                    </div>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <div class="pagination"><ul><?php echo ($posts['page']); ?></ul></div>
    <hr>
</div>
    
                <div class="footer">
                    <i class="iconfont">&#xe608</i><?php echo ($vo["join_count"]); ?>&nbsp;
                    <i class="iconfont">&#xe610</i><?php echo ($vo["post_hits"]); ?>
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


 <script src="/thcmf/tpl/simplebootx/Public/js/imagesloaded.pkgd.min.js"></script>
    <script src="/thcmf/tpl/simplebootx/Public/js/masonry.pkgd.min.js"></script>
    <script>
    var $container=$('#container').masonry({
          columnWidth: '.grid-sizer',
          itemSelector: '.item'
        });
    // layout Masonry again after all images have loaded
    $container.imagesLoaded( function() {
      $container.masonry();
    });
    
    </script>
</body>
</html>