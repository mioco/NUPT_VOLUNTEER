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
	<div class="wrap jj">
		<div class="common-form">
			<form method="post" class="form-horizontal J_ajaxForm" action="<?php echo U('nav/edit_post');?>">
				<fieldset>
					<div class="control-group">
						<label class="control-label">菜单分类:</label>
						<div class="controls">
							<select name="cid" id="navcid_select" class="normal_select">
								<?php if(is_array($navcats)): foreach($navcats as $key=>$vo): $navcid_selected=$navcid==$vo['navcid']?"selected":""; ?>
								<option value="<?php echo ($vo["navcid"]); ?>" <?php echo ($navcid_selected); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">上级:</label>
						<div class="controls">
							<select name="parentid" class="normal_select">
								<option value="0">/</option>
								<?php echo ($nav_trees); ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">标签:</label>
						<div class="controls">
							<input type="text" class="input" name="label" value="<?php echo ($label); ?>"><span class="must_red">*</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">地址:</label>
						<div class="controls">
							<input type="radio" name="nav" id="outlink">
							<input type="text" class="input" name="href" id="outlink_input" value="http://">
							<input type="radio" name="nav" id="selecturl">
							<select name="href" id="selecthref" class="normal_select">
								<option disabled>默认</option>
								<option value="home">首页</option>
								<?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><option disabled><?php echo ($vo["name"]); ?></option>
									<?php if(is_array($vo['items'])): foreach($vo['items'] as $key=>$voo): ?><option value='<?php echo ($voo["rule"]); ?>'><?php echo ($voo["label"]); ?></option><?php endforeach; endif; endforeach; endif; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">打开方式:</label>
						<div class="controls">
							<select name="target">
								<option value="">默认方式</option>
								<option value="_blank">新窗口打开</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">图标:</label>
						<div class="controls">
							<input type="text" class="input" name="icon" value="<?php echo ($icon); ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">显示:</label>
						<div class="controls">
							<select name="status" class="normal_select">
								<option value="1">显示</option>
								<?php $status_selected=empty($status)?"selected":""; ?>
								<option value="0" <?php echo ($status_selected); ?>>隐藏</option>
							</select>
						</div>
					</div>
				</fieldset>
				<div class="form-actions">
					<input type="hidden" class="input" name="id" value="<?php echo ($id); ?>">
					<button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">更新</button>
					<a class="btn" href="/thcmf/index.php/Admin/Nav">返回</a>
				</div>
			</form>
		</div>
	</div>
	<script src="/thcmf/statics/js/common.js"></script>
	<script>
		$(function() {
			$("#navcid_select").change(function() {
				if(location.search.indexOf("?")>=0){
					location.href = location.href + "&cid=" + $(this).val();
				}else{
					location.href = location.href + "?cid=" + $(this).val();
				}
				
				
			});

			$("#selecthref").click(function() {
				checkChange(2);
			});
			$("input[name='href']").click(function() {
				checkChange(1);
			});

			var opt = $("#selecthref option[value='" + '<?php echo ($hrefold); ?>' + "']");
			if (opt.length > 0) {
				opt.attr('selected', 'selected');
				checkChange(2);
			} else {
				checkChange(1);
				$('#outlink_input').val('<?php echo ($hrefold); ?>');
			}

			function checkChange(i) {
				if (i == 1) {
					//自动输入url
					$('#outlink_input').attr('name', 'href');
					$('#selecthref').removeAttr('name');
					$('#outlink').attr({
						'checked' : 'checked',
						'name' : 'nav'
					});
				} else {
					//选择链接url
					$('#selecthref').attr('name', 'href');
					$('#outlink_input').removeAttr('name');
					$('#selecturl').attr({
						'checked' : 'checked',
						'name' : 'nav'
					});
				}
			}
		});
	</script>
</body>
</html>