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
			<li class="active"><a href="javascript:;">所有文章</a></li>
			<li><a href="<?php echo U('AdminPost/add',array('term'=>empty($term['term_id'])?'':$term['term_id']));?>" target="_self">添加文章</a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo U('AdminPost/index');?>">
			<div class="search_type cc mb10">
				<div class="mb10">
					<span class="mr20">分类： 
						<select class="select_2" name="term">
							<option value='0'>全部</option><?php echo ($taxonomys); ?>
						</select> &nbsp;&nbsp;
						时间：
						<input type="text" name="start_time" class="J_date" value="<?php echo ((isset($formget["start_time"]) && ($formget["start_time"] !== ""))?($formget["start_time"]):''); ?>" style="width: 80px;" autocomplete="off">-
						<input type="text" class="J_date" name="end_time" value="<?php echo ($formget["end_time"]); ?>" style="width: 80px;" autocomplete="off"> &nbsp; &nbsp;
						关键字： 
						<input type="text" name="keyword" style="width: 200px;" value="<?php echo ($formget["keyword"]); ?>" placeholder="请输入关键字...">
						<input type="submit" class="btn btn-primary" value="搜索" />
					</span>
				</div>
			</div>
		</form>
		<form class="J_ajaxForm" action="" method="post">
			<div class="table-actions">
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/listorders');?>">排序</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/check',array('check'=>1));?>" data-subcheck="true">审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/top',array('top'=>1));?>" data-subcheck="true">置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/top',array('untop'=>1));?>" data-subcheck="true">取消置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/recommend',array('recommend'=>1));?>" data-subcheck="true">推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/recommend',array('unrecommend'=>1));?>" data-subcheck="true">取消推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
				<button class="btn btn-primary btn-small J_articles_move" type="button">批量移动</button>
			</div>
			<table class="table table-hover table-bordered table-list">
				<thead>
					<tr>
						<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
						<th width="50">排序</th>
						<th>标题</th>
						<th>栏目</th>
						<th width="50">点击量</th>
						<th width="50">评论量</th>
						<th width="50">关键字</th>
						<th width="50">来源</th>
						<th width="50">摘要</th>
						<th width="50">缩略图</th>
						<th width="80">发布人</th>
						<th width="70">发布时间</th>
						<th width="50">状态</th>
						<th width="60">操作</th>
					</tr>
				</thead>
				<?php $status=array("1"=>"已审核","0"=>"未审核"); $top_status=array("1"=>"已置顶","0"=>"未置顶"); $recommend_status=array("1"=>"已推荐","0"=>"未推荐"); ?>
				<?php if(is_array($posts)): foreach($posts as $key=>$vo): ?><tr>
					<td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="<?php echo ($vo["tid"]); ?>" title="ID:<?php echo ($vo["tid"]); ?>"></td>
					<td><input name="listorders[<?php echo ($vo["tid"]); ?>]" class="input input-order" type="text" size="5" value="<?php echo ($vo["listorder"]); ?>" title="ID:<?php echo ($vo["tid"]); ?>"></td>
					<td><a href="<?php echo U('portal/article/index',array('id'=>$vo['tid']));?>" target="_blank"> <span><?php echo ($vo["post_title"]); ?></span></a></td>
					<td><?php echo ($terms[$vo['term_id']]); ?></td>
					<td><?php echo ($vo["post_hits"]); ?></td>
					<td><a href="javascript:open_iframe_dialog('<?php echo U('comment/commentadmin/index',array('post_id'=>$vo['id']));?>','评论列表')"><?php echo ($vo["comment_count"]); ?></a></td>
					<td><?php echo ($excerpt_keywords = empty($vo['post_keywords'])?"":'已填写'); ?></td>
					<td><?php echo ($excerpt_source = empty($vo['post_source'])?" ":'已填写'); ?></td>
					<td><?php echo ($excerpt_excerpt = empty($vo['post_excerpt'])?" ":'已填写'); ?></td>
					<td>
						<?php $smeta=json_decode($vo['smeta'],true); ?>
						<?php if(!empty($smeta['thumb'])): ?><a href="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" target='_blank'>查看</a><?php endif; ?>
					</td>
					<td><?php echo ($users[$vo['post_author']]['user_login']); ?></td>
					<td><?php echo ($vo["post_date"]); ?></td>
					<td><?php echo ($status[$vo['post_status']]); ?><br><?php echo ($top_status[$vo['istop']]); ?><br><?php echo ($recommend_status[$vo['recommended']]); ?>
					</td>
					<td>
						<a href="<?php echo U('AdminPost/edit',array('term'=>empty($term['term_id'])?'':$term['term_id'],'id'=>$vo['id']));?>">修改</a> | 
						<a href="<?php echo U('AdminPost/delete',array('term'=>empty($term['term_id'])?'':$term['term_id'],'tid'=>$vo['tid']));?>" class="J_ajax_del">删除</a></td>
				</tr><?php endforeach; endif; ?>
				<tfoot>
					<tr>
						<th width="15"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></th>
						<th width="50">排序</th>
						<th>标题</th>
						<th>栏目</th>
						<th width="50">点击量</th>
						<th width="50">评论量</th>
						<th width="50">关键字</th>
						<th width="50">来源</th>
						<th width="50">摘要</th>
						<th width="50">缩略图</th>
						<th width="80">发布人</th>
						<th width="70">发布时间</th>
						<th width="50">状态</th>
						<th width="60">操作</th>
					</tr>
				</tfoot>
			</table>
			<div class="table-actions">
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/listorders');?>">排序</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/check',array('check'=>1));?>" data-subcheck="true">审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/check',array('uncheck'=>1));?>" data-subcheck="true">取消审核</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/top',array('top'=>1));?>" data-subcheck="true">置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/top',array('untop'=>1));?>" data-subcheck="true">取消置顶</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/recommend',array('recommend'=>1));?>" data-subcheck="true">推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/recommend',array('unrecommend'=>1));?>" data-subcheck="true">取消推荐</button>
				<button class="btn btn-primary btn-small J_ajax_submit_btn" type="submit" data-action="<?php echo U('AdminPost/delete');?>" data-subcheck="true" data-msg="你确定删除吗？">删除</button>
				<button class="btn btn-primary btn-small J_articles_move" type="button">批量移动</button>
			</div>
			<div class="pagination"><?php echo ($Page); ?></div>

		</form>
	</div>
	<script src="/thcmf/statics/js/common.js"></script>
	<script>
		function refersh_window() {
			var refersh_time = getCookie('refersh_time');
			if (refersh_time == 1) {
				window.location = "<?php echo U('AdminPost/index',$formget);?>";
			}
		}
		setInterval(function() {
			refersh_window();
		}, 2000);
		$(function() {
			setCookie("refersh_time", 0);
			Wind.use('ajaxForm', 'artDialog', 'iframeTools', function() {
				//批量移动
				$('.J_articles_move').click(
						function(e) {
							var str = 0;
							var id = tag = '';
							$("input[name='ids[]']").each(function() {
								if ($(this).attr('checked')) {
									str = 1;
									id += tag + $(this).val();
									tag = ',';
								}
							});
							if (str == 0) {
								art.dialog.through({
									id : 'error',
									icon : 'error',
									content : '您没有勾选信息，无法进行操作！',
									cancelVal : '关闭',
									cancel : true
								});
								return false;
							}
							var $this = $(this);
							art.dialog.open(
									"/thcmf/index.php?g=portal&m=AdminPost&a=move&ids="
											+ id, {
										title : "批量移动",
										width : "80%"
									});
						});
			});
		});
	</script>
</body>
</html>