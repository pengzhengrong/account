<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <title>测试</title>
  	<link rel="stylesheet" type="text/css" href="<?php echo __PATH_STATIC__.'uploadstatic/css/game.css';?>" />
  	<link rel="stylesheet" type="text/css" href="<?php echo __PATH_STATIC__.'uploadstatic/css/dialog.css';?>" />
    <script  type="text/javascript" src="<?php echo __PATH_STATIC__.'uploadstatic/js/jquery-1.4.4.min.js';?>"></script>
 	<script type="text/javascript" src="<?php echo __PATH_STATIC__.'uploadstatic/js/xuanwen_manage.js' ; ?> " ></script>
	<script type="text/javascript" src="<?php echo __PATH_STATIC__.'uploadstatic/js/dialog.js' ;?>" ></script>
	<script type="text/javascript" src="<?php echo __PATH_STATIC__.'swfupload/swf2ckeditor.js' ; ?>" ></script>
 </head>
 <body>
 <table>
 	 <tr>
	<td>图片：</td>
	<td>
		<fieldset id="pics" >
			<legend>图片列表</legend>
		</fieldset>
<input type="button" value="批量上传" class="btn1"
			onclick="javascript:flashupload('pics_multifile', '附件上传','pics',change_multifile,'10,gif|jpg|jpeg|png|bmp,0')" />
<span class="tip">宽700</span>
</td>
</tr>
 </table>
 </body>
 <script type="text/javascript">

	 function flashupload(uploadid, name, textareaid, funcName, args) {
			var args = args ? '&args='+args : '';
			var setting = '&type=' + uploadid;
			window.top.art.dialog(
					{
						title:name,
						id:uploadid,
						iframe:'/upload/start?m=upload&c=attachments&a=swfupload'+args+setting,
						width:'500',
						height:'420'
					}, 
					function(){ 
						if(funcName) {
							funcName.apply(
									this,[uploadid,textareaid]);}
						else {submit_ckeditor(uploadid,textareaid);}
					},
					 function(){
						 window.top.art.dialog({id:uploadid}).close()}
					 );
		}
 
	 function change_multifile(uploadid,returnid){
			var d = window.top.art.dialog({id:uploadid}).data.iframe;
			var in_content = d.$("#att-status").html().substring(1);
			var in_filename = d.$("#att-name").html().substring(1);
		    var in_wh = d.$("#att-wh").html().substring(1);
			var str = '';
			var contents = in_content.split('|');
		    var wh = in_wh.split('|');
			var filenames = in_filename.split('|');
			$('#'+returnid+'_tips').css('display','none');
			if(contents=='') return true;
		    var len = $('#'+returnid).find('li').size();
		    var lendiv = $('#'+returnid).parent().find('div').size();
		    len += lendiv;
			$.each( contents, function(i, n) {
				var ids = parseInt(Math.random() * 10000 + 10*i); 
				var filename = filenames[i].substr(0,filenames[i].indexOf('.'));
		        var index = len + i;
		        var imgstr = "<img src='"+n+"' width='100' /><br />";
				str += "<li l='"+n+"' id='multifile"+ids+"' class='jsval_"+returnid+"' index='" + index + "'><img src='"+n+"' width='100' /><br /><input type='text' name='"+returnid+"_fileurl[]' value='"+n+"' style='width:310px;' class='input-text'><a href=\"javascript:remove_div('multifile"+ids+"')\">移除</a> <a href=\"javascript:add_content('multifile"+ids+"','"+returnid+"')\">添加到内容</a></li>";
			});
			$('#'+returnid).append(str);
		} 

		function add_content(id,returnid){
		    var index = $('#' + id ).attr('index');
		    var l = $('#' + id ).attr('l');
		    var code = '';
		    if( returnid == 'pics'){
		    		code = '<img index="'+index+'" src="'+l+'" />';
// 		        code = '<!--IMG#' + index + '-->';
		    }
		    CKEDITOR.instances.content.insertHtml(code);
		}

		function remove_div(id) 
		{
			//$('#'+id).remove();
			var meindex = $('#'+id).attr("index");
			var meclass = $('#'+id).attr("class");
			var mesrc	= $('#'+id).attr("l");
			$('#'+id).remove();
			var len 		= $('.'+meclass).length;
			var mycontent 	= CKEDITOR.instances.content.getData();
			if( meclass == 'jsval_pics' )
			{
				mycontent = mycontent.replaceAll('<img index="'+meindex+'" src="'+mesrc+'" />','');
			}
			
			if( len > 0 )
			{
				for(var i = 0; i < len; i++)
				{
					var checkindex = $('.'+meclass).eq(i).attr("index");
					if(checkindex > meindex)
					{
						var newindex = checkindex - 1;
						$('.'+meclass).eq(i).attr("index",newindex);
						if(meclass == 'jsval_pics')
						{
							mycontent = mycontent.replaceAll('<img index="'+checkindex+'"','<img index="'+newindex+'"');
						}
					}
				}
			}
			CKEDITOR.instances.content.setData(mycontent);  
		}
		
	function apk_upload(uploadid,returnid){
		var d = window.top.art.dialog({id:uploadid}).data.iframe;
		var in_content = d.$("#att-status").html().substring(1);
		var in_content = in_content.split('|');
		$('#'+returnid).attr("value",in_content[0]);
		if(typeof(window.top.apk_size)!='undefined'){
			if( returnid == 'apk'){
				$('#apk_file_size').val(get_file_size(window.top.apk_size));
			}
		 	if( returnid == 'apk1'){
				$('#apk1_file_size').val(get_file_size(window.top.apk_size));
			}
			if( returnid == 'apk2'){
				$('#apk2_file_size').val(get_file_size(window.top.apk_size));
			} 
		}
	}

	function get_file_size(filesize){
		if(filesize >= 1073741824) {
			filesize = Math.round(filesize / 1073741824 * 100) / 100 + ' GB';
		} else if(filesize >= 1048576) {
			filesize = Math.round(filesize / 1048576 * 100) / 100 + ' MB';
		} else if(filesize >= 1024) {
			filesize = Math.round(filesize / 1024 * 100) / 100 + ' KB';
		} else {
			filesize = filesize + ' Bytes';
		}
		return filesize;
	}

	function remove_content_image(_this){
		console.info(_this);
		$(_this).parent('div.screen_item').remove();
	}

	$('#back').click(function(){
		window.location.href = "?m=game&c=advice&a=init&pc_hash=<?php echo $_SESSION['pc_hash'];?>";
	});

 	function doValid(){
		if($('#name').val()==''){
			alert('请填入游戏名称');
			return false;
		}/* else if($('#apk').val()==''){
			alert('请上传apk文件');
			return false;
		} *//* else if($('img', $('#pics')).length<3){
			alert('游戏截图不得小于3张');
			return false;
		}  */else{
			return true;
		}
	} 

	function trim_the_str(_this, count){
		var order = $(_this).val();
		order = order.substr(0, count);
		$(_this).val(order);
	}

	function icon_image(uploadid,returnid){
		var d = window.top.art.dialog({id:uploadid}).data.iframe;
		var in_content = d.$("#att-status").html().substring(1);
		if(in_content=='') return false;
		if(!IsImg(in_content)) {
			alert('选择的类型必须为图片类型');
			return false;
		}
		if($('#'+returnid+'_preview').attr('src')) {
			$('#'+returnid+'_preview').attr('src',in_content);
		}
		$('#'+returnid).val(in_content);
	}
</script>
 </html>