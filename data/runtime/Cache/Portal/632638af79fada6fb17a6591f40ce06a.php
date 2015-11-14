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
	        <li class="active"><a href="#A" data-toggle="tab">基本属性</a></li>
	        <li><a href="#B" data-toggle="tab">SEO设置</a></li>
	        <li><a href="#C" data-toggle="tab">模板设置</a></li>
	    </ul>
		<form class="form-horizontal J_ajaxForm" name="myform" id="myform" action="<?php echo u('AdminTerm/add_post');?>" method="post">
			<div class="tabbable">
		        <div class="tab-content">
		          <div class="tab-pane active" id="A">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td width="140">上级:</td>
									<td><select name="parent" class="normal_select">
											<option value="0">作为一级分类</option>
											<?php echo ($terms_tree); ?>
									</select></td>
								</tr>
								<tr>
									<td>名称:</td>
									<td><input type="text" class="input" name="name" value=""><span class="must_red">*</span></td>
								</tr>
								<tr>
									<td>描述:</td>
									<td><textarea name="description" rows="5" cols="57"></textarea></td>
								</tr>
								<tr>
									<td>类型:</td>
									<td><select name="taxonomy">
											<?php if(is_array($taxonomys)): foreach($taxonomys as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
									</select></td>
								</tr>
							</tbody>
						</table>
		          </div>
		          <div class="tab-pane" id="B">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<tr>
									<td width="180">SEO标题:</td>
									<td><input type="text" class="input" name="seo_title" value=""></td>
								</tr>
								<tr>
									<td>SEO关键字:</td>
									<td><input type="text" class="input" name="seo_keywords" value=""></td>
								</tr>
								<tr>
									<td>SEO描述:</td>
									<td><textarea name="seo_description" rows="5" cols="57"></textarea></td>
								</tr>
							</tbody>
						</table>
		          </div>
		          <div class="tab-pane" id="C">
		          		<table cellpadding="2" cellspacing="2" width="100%">
							<tbody>
								<?php $tpl_list=sp_admin_get_tpl_file_list(); ?>
								<tr>
									<td width="180">列表页模板:</td>
									<td>
										<?php $list_tpls=$tpl_list; unset($list_tpls['list']); ?>
					              		<select  class="normal_select" name="list_tpl">
					              			<option value="list">list<?php echo C("TMPL_TEMPLATE_SUFFIX");?></option>
					              			<?php if(is_array($list_tpls)): foreach($list_tpls as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); echo C("TMPL_TEMPLATE_SUFFIX");?></option><?php endforeach; endif; ?>
					              		</select>
									</td>
								</tr>
								<tr>
									<td>单文章模板:</td>
									<td>
										<?php $article_tpls=$tpl_list; unset($article_tpls['article']); ?>
					              		<select  class="normal_select" name="one_tpl">
					              			<option value="article">article<?php echo C("TMPL_TEMPLATE_SUFFIX");?></option>
					              			<?php if(is_array($article_tpls)): foreach($article_tpls as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); echo C("TMPL_TEMPLATE_SUFFIX");?></option><?php endforeach; endif; ?>
					              		</select>
									</td>
								</tr>
							</tbody>
						</table>
		          </div>
		        </div>
		    </div>
		     <div class="form-actions">
		           <button class="btn btn-primary btn_submit J_ajax_submit_btn"type="submit">提交</button>
		      		<a class="btn" href="<?php echo U('AdminTerm/index');?>">返回</a>
		      </div>
		</form>
	</div>
	<script type="text/javascript" src="/thcmf/statics/js/common.js"></script>
</body>
</html>