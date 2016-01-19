<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>phpcms V9 - 后台管理中心</title>
<link href="<?php echo __PATH_STATIC__ ;?>swfupload/swfupload.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo __PATH_STATIC__.'/uploadstatic/css/reset.css';?>" />
<link rel="stylesheet" type="text/css" href="<?php echo __PATH_STATIC__.'/uploadstatic/css/zh-cn-system.css';?>" />
<link rel="stylesheet" type="text/css" href="<?php echo __PATH_STATIC__.'/uploadstatic/css/table_form.css';?>" />
<script  type="text/javascript" src="<?php echo __PATH_STATIC__.'uploadstatic/js/jquery-1.4.4.min.js';?>"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo __PATH_STATIC__ ;?>swfupload/swfupload.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo __PATH_STATIC__ ;?>swfupload/fileprogress.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo __PATH_STATIC__ ;?>swfupload/handlers.js"></script>
<script type="text/javascript">
//初始化SWFUpload
var swfu = '';
		$(document).ready(function(){
// 		swfu = new SWFUpload(
		var settings = {
			flash_url:"http://account.test.com:8899/static/swfupload/swfupload.swf",
			upload_url:"http://account.test.com:8899/upload/start?m=upload&c=attachments&a=swfupload&dosubmit=1&type=pics_multifile",
			file_post_name : "Filedata",
			post_params:{
				"SWFUPLOADSESSID":"<?php echo session_id();?>",
				"dosubmit":"1",
				"watermark_enable":"1",
				"filetype_post":"gif|jpg|jpeg|png|bmp"
			},
			file_size_limit:"2097152",
			file_types:"*.gif;*.jpg;*.jpeg;*.png;*.bmp",
			file_types_description:"All Files",
			file_upload_limit:"10",
			custom_settings : {
				progressTarget : "fsUploadProgress",
				cancelButtonId : "btnCancel"
			},
	 
			button_image_url: "",
			button_width: 75,
			button_height: 28,
			button_placeholder_id: "buttonPlaceHolder",
			button_text_style: "",
			button_text_top_padding: 3,
			button_text_left_padding: 12,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,

			file_dialog_start_handler : fileDialogStart,
			file_queued_handler : fileQueued,
			file_queue_error_handler:fileQueueError,
			file_dialog_complete_handler:fileDialogComplete,
			upload_progress_handler:uploadProgress,
			upload_error_handler:uploadError,
			upload_success_handler:uploadSuccess,
			upload_complete_handler:uploadComplete
		};
// 			});
		swfu = new SWFUpload(settings);
		});</script>
		</head>
		<body>
<div class="pad-10">
    <div class="col-tab">
        <ul class="tabBut cu-li">
            <li id="tab_swf_1"  class="on" onclick="SwapTab('swf','on','',5,1);">上传附件</li>
            <li id="tab_swf_2" onclick="SwapTab('swf','on','',5,2);">网络文件</li>
        </ul>
         <div id="div_swf_1" class="content pad-10 ">
        	<div>
 				<div class="addnew" id="addnew">
					<span id="buttonPlaceHolder"></span>
				</div> 
				<input type="button" id="btupload" value="开始上传" onClick="swfu.startUpload();" />
                <div id="nameTip" class="onShow">最多上传<font color="red"> 10</font> 个附件,单文件最大 <font color="red">2 GB</font></div>
                <div class="bk3"></div>
				
                <div class="lh24">支持 <font style="font-family: Arial, Helvetica, sans-serif">gif、jpg、jpeg、png、bmp</font> 格式。</div><input type="checkbox" id="watermark_enable" value="1" checked onclick="change_params()"> 是否添加水印        	</div> 	
    		<div class="bk10"></div>
        	<fieldset class="blue pad-10" id="swfupload">
        	<legend>列表</legend>
        	<ul class="attachment-list"  id="fsUploadProgress">    
        	</ul>
    		</fieldset>
    	</div>
        <div id="div_swf_2" class="contentList pad-10 hidden">
        <div class="bk10"></div>
        	请输入网络地址<div class="bk3"></div><input type="text" name="info[filename]" class="input-text" value=""  style="width:350px;"  onblur="addonlinefile(this)">
		<div class="bk10"></div>
        </div>    	
    	             
    <div id="att-status" class="hidden"></div>
        <div id="att-wh" class="hidden"></div>
     <div id="att-status-del" class="hidden"></div>
    <div id="att-name" class="hidden"></div>
<!-- swf -->
</div>
</body>
<script type="text/javascript">
if ($.browser.mozilla) {
	window.onload=function(){
	  if (location.href.indexOf("&rand=")<0) {
			location.href=location.href+"&rand="+Math.random();
		}
	}
}
function imgWrap(obj){
	$(obj).hasClass('on') ? $(obj).removeClass("on") : $(obj).addClass("on");
}

function SwapTab(name,cls_show,cls_hide,cnt,cur) {
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $('#div_'+name+'_'+i).show();
			 $('#tab_'+name+'_'+i).addClass(cls_show);
			 $('#tab_'+name+'_'+i).removeClass(cls_hide);
		}else{
			 $('#div_'+name+'_'+i).hide();
			 $('#tab_'+name+'_'+i).removeClass(cls_show);
			 $('#tab_'+name+'_'+i).addClass(cls_hide);
		}
	}
}

function addonlinefile(obj) {
	var strs = $(obj).val() ? '|'+ $(obj).val() :'';
	$('#att-status').html(strs);
}

function change_params(){
	if($('#watermark_enable').attr('checked')) {
		swfu.addPostParam('watermark_enable', '1');
	} else {
		swfu.removePostParam('watermark_enable');
	}
}
function set_iframe(id,src){
	$("#"+id).attr("src",src); 
}
function album_cancel(obj,id,source){
	var src = $(obj).children("img").attr("path");
	var filename = $(obj).attr('title');
	if($(obj).hasClass('on')){
		$(obj).removeClass("on");
		var imgstr = $("#att-status").html();
		var length = $("a[class='on']").children("img").length;
		var strs = filenames = '';
		$.get('upload/start?m=upload&c=attachments&a=swfupload_json_del&aid='+id+'&src='+source+'&filename='+filename);
		for(var i=0;i<length;i++){
			strs += '|'+$("a[class='on']").children("img").eq(i).attr('path');
			filenames += '|'+$("a[class='on']").children("img").eq(i).attr('title');
		}
		$('#att-status').html(strs);
		$('#att-status').html(filenames);
	} else {
		var num = $('#att-status').html().split('|').length;
		var file_upload_limit = '10';
		if(num > file_upload_limit) {alert('不能选择超过'+file_upload_limit+'个附件'); return false;}
		$(obj).addClass("on");
		$.get('upload/start?m=upload&c=attachments&a=swfupload_json&aid='+id+'&src='+source+'&filename='+filename);
		$('#att-status').append('|'+src);
		$('#att-name').append('|'+filename);
	}
}
</script>
</html>

