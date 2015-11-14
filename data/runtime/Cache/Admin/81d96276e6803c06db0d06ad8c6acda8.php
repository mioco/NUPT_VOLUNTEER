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
<style>.expander{margin-left: -20px;}</style>
</head>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
	<ul class="nav nav-tabs">
     <li class="active"><a href="javascript:;">角色授权</a></li>
  </ul>
  <form class="J_ajaxForm" action="<?php echo U('Rbac/authorize_post');?>" method="post">
    <div class="table_full">
      <table width="100%" cellspacing="0" id="dnd-example">
        <tbody>
         <?php echo ($categorys); ?>
        </tbody>
      </table>
    </div>
    <div class="form-actions">
    	<input type="hidden" name="roleid" value="<?php echo ($roleid); ?>" />
        <button class="btn btn_submit btn-primary mr10 J_ajax_submit_btn" type="submit">授权</button>
        <a class="btn" href="/thcmf/index.php/Admin/Rbac">返回</a>
   	</div>
  </form>
</div>
<script type="text/javascript">
var ajaxForm_list = $('form.J_ajaxFsorm');
if (ajaxForm_list.length) {
    Wind.use('ajaxForm', 'artDialog', function () {
        if ($.browser.msie) {
            //ie8及以下，表单中只有一个可见的input:text时，会整个页面会跳转提交
            ajaxForm_list.on('submit', function (e) {
                //表单中只有一个可见的input:text时，enter提交无效
                e.preventDefault();
            });
        }

        $('button.J_ajax_submit_btn').bind('click', function (e) {
            e.preventDefault();
            /*var btn = $(this).find('button.J_ajax_submit_btn'),
					form = $(this);*/
            var btn = $(this),
                form = btn.parents('form.J_ajaxForm');

            //批量操作 判断选项
            if (btn.data('subcheck')) {
                btn.parent().find('span').remove();
                if (form.find('input.J_check:checked').length) {
                    var msg = btn.data('msg');
                    if (msg) {
                        art.dialog({
                            id: 'warning',
                            icon: 'warning',
                            content: btn.data('msg'),
                            cancelVal: '关闭',
                            cancel: function () {
                                btn.data('subcheck', false);
                                btn.click();
                            }
                        });
                    } else {
                        btn.data('subcheck', false);
                        btn.click();
                    }

                } else {
                    $('<span class="tips_error">请至少选择一项</span>').appendTo(btn.parent()).fadeIn('fast');
                }
                return false;
            }

            //ie处理placeholder提交问题
            if ($.browser.msie) {
                form.find('[placeholder]').each(function () {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });
            }

            form.ajaxSubmit({
                url: btn.data('action') ? btn.data('action') : form.attr('action'),
                //按钮上是否自定义提交地址(多按钮情况)
                dataType: 'json',
                beforeSubmit: function (arr, $form, options) {
                    var text = btn.text();

                    //按钮文案、状态修改
                    btn.text(text + '中...').attr('disabled', true).addClass('disabled');
                },
                success: function (data, statusText, xhr, $form) {
                    var text = btn.text();

                    //按钮文案、状态修改
                    btn.removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();

                    if (data.state === 'success') {
                        $('<span class="tips_success">' + data.info + '</span>').appendTo(btn.parent()).fadeIn('slow').delay(1000).fadeOut(function () {
                            if (data.referer) {
                                //返回带跳转地址
                                if (window.parent.art) {
                                    //iframe弹出页
                                    window.parent.location.href = data.referer;
                                } else {
                                    window.location.href = data.referer;
                                }
                            } else {
                                if (window.parent.art) {
                                    reloadPage(window.parent);
                                } else {
                                    //刷新当前页
                                    reloadPage(window);
                                }
                            }
                        });
                    } else if (data.state === 'fail') {
                        $('<span class="tips_error">' + data.info + '</span>').appendTo(btn.parent()).fadeIn('fast');
                        btn.removeProp('disabled').removeClass('disabled');
                    }
                }
            });
        });

    });
}
$(document).ready(function () {
	Wind.css('treeTable');
    Wind.use('treeTable', function () {
        $("#dnd-example").treeTable({
            indent: 20
        });
    });
});

function checknode(obj) {
    var chk = $("input[type='checkbox']");
    var count = chk.length;
    var num = chk.index(obj);
    var level_top = level_bottom = chk.eq(num).attr('level');
    for (var i = num; i >= 0; i--) {
        var le = chk.eq(i).attr('level');
        if (eval(le) < eval(level_top)) {
            chk.eq(i).attr("checked", true);
            var level_top = level_top - 1;
        }
    }
    for (var j = num + 1; j < count; j++) {
        var le = chk.eq(j).attr('level');
        if (chk.eq(num).attr("checked") == "checked") {
            if (eval(le) > eval(level_bottom)){
            	chk.eq(j).attr("checked", true);
            }
            else if (eval(le) == eval(level_bottom)){
            	break;
            }
        } else {
            if (eval(le) > eval(level_bottom)){
            	chk.eq(j).attr("checked", false);
            }else if(eval(le) == eval(level_bottom)){
            	break;
            }
        }
    }
}
</script>
</body>
</html>