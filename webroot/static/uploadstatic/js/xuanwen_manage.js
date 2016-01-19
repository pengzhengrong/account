function func_sys_txtlen(txt)
{
	var txtlen 	= txt.length;
	var curlen	= 0;
	for(var i = 0; i < txtlen; i++) 
	{
		txt.charCodeAt(i) < 0 || txt.charCodeAt(i) > 255 ? curlen += 2 : curlen += 1;
	}
	return curlen;
}
function func_sys_strlen(id)
{
	var v 		= $('#' + id).val();
	var curlen	= 0;
	for(var i = 0; i < v.length; i++) 
	{
		v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255 ? curlen += 2 : curlen += 1;
	}
	return curlen;
}

//初始化字符长度
function func_sys_inputstrtips(id,tips,maxlen)
{
	var v 		= $('#' + id).val();
	var curlen	= 0;
	for(var i = 0; i < v.length; i++) 
	{
		v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255 ? curlen += 2 : curlen += 1;
	}
	var outlen 		= maxlen - curlen;
	var tipsstr 	= '已输入' + curlen + '个字符,还可输入'+ outlen + '个字符';
	$('#' + tips).html( tipsstr );
}
/*
*file:上传的文件
*returnid:操作ID
*/
function func_sys_addvideo(returnid,file,title,duration,option)
{
	var index	= $('#'+returnid+' li').length;
	var i		= index + 1;
	var ids		= parseInt(Math.random() * 10000 + 10*i); 
	var preView = '';
	str = "<li l='"+file+"' id='multifile"+ids+"' class='jsval_"+returnid+"' index='" + index + "'><img src='"+file+"' width='100' /><br /><input type='text' name='"+returnid+"_filewidth[]' value='' style='width: 30px;' class='input-text'><span>宽</span> <input type='text' name='"+returnid+"_fileheight[]' value='' style='width: 30px;' class='input-text'><span>高</span><input type='text' style='width:30px;margin-left:3px;' class='input-text' name='"+returnid+"_fileorder[]' /><span>显示顺序</span> <input type='text' name='"+returnid+"_fileduration[]' value='"+duration+"' style='width: 30px;' class='input-text'><span>时长</span>"+option+"<br /><input type='text' name='"+returnid+"_filedes[]' value='"+title+"' style='width: 486px;' class='input-text'> <span>标题</span><input type='text' name='"+returnid+"_fileurl[]' value='"+file+"' style='width:310px;' class='input-text'> <input type='text' name='"+returnid+"_filename[]' value='' style='width:160px;' class='input-text' onfocus=\"if(this.value == this.defaultValue) this.value = ''\" onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('multifile"+ids+"')\">移除</a> <a href=\"javascript:add_content('multifile"+ids+"','"+returnid+"')\">添加到内容</a></li>";
	$('#' + returnid).append(str);
}

/*
*file:上传视频图片
*returnid:操作ID
*/
function func_sys_addimgFile(returnid,file,title,w,h)
{
	var index	= $('#'+returnid+' li').length;
	var i		= index + 1;
	var ids		= parseInt(Math.random() * 10000 + 10*i); 
	var preView = '';
	str = "<li l='"+file+"' id='multifile"+ids+"' class='jsval_"+returnid+"' index='" + index + "'><img src='"+file+"' width='100' /><br /><input type='text' name='"+returnid+"_filewidth[]' value='"+w+"' style='width: 30px;' class='input-text'><span>宽</span> <input type='text' name='"+returnid+"_fileheight[]' value='"+h+"' style='width: 30px;' class='input-text'><span>高</span><input type='text' style='width:30px;margin-left:3px;' class='input-text' name='"+returnid+"_fileorder[]' /><span>显示顺序</span> <input type='text' name='"+returnid+"_fileduration[]' value='' style='width: 30px;' class='input-text'><span>时长</span><br /><input type='text' name='"+returnid+"_filedes[]' value='"+title+"' style='width: 486px;' class='input-text'> <span>标题</span><input type='text' name='"+returnid+"_fileurl[]' value='"+file+"' style='width:310px;' class='input-text'> <input type='text' name='"+returnid+"_filename[]' value='' style='width:160px;' class='input-text' onfocus=\"if(this.value == this.defaultValue) this.value = ''\" onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('multifile"+ids+"')\">移除</a> <a href=\"javascript:add_content('multifile"+ids+"','"+returnid+"')\">添加到内容</a></li>";
	$('#' + returnid).append(str);
}

// 视频预览
function func_sys_VideoPreView(me)
{
	var file = $(me).parent().attr("l");
	window.open("?m=content&c=newslibrary&a=add&prevideosubmit=1&file="+file+"&pc_hash="+pc_hash+"",'预览视频',"width=328,height=600, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
}

// 列表页视频预览
function func_sys_VideoLPreView(uuid)
{
	window.open("?m=content&c=newslibrary&a=add&prevideosubmit=1&uuid="+uuid+"&pc_hash="+pc_hash+"",'预览视频',"width=328,height=600, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=n o, status=no");
}

function func_sys_clearData(content)
{
	var mycontent 	= CKEDITOR.instances.content.getData();
	if(mycontent == '')
	{
		alert('清洗内容不能为空');
		return false;
	}
	$.ajax({
		    type: "POST",  
			url : '?m=content&c=newslibrary&a=cleandata&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data : {content:mycontent},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					CKEDITOR.instances.content.setData(json.msg);
				}else{
					alert(json.msg);
				}
	        }
	});
}

// 自定义多文件上传函数
function func_sys_multiUpload(uploadid,returnid){
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
        var tmp = wh[i].split('=');
		
        if(!tmp[0]){
        	tmp[0] = 0;
        }
        if(!tmp[1]){
        	tmp[1] = 0;
        }

		if(n.indexOf('mp3') !== -1){
        	var imgstr = "";
        }else if(n.indexOf('mp4') !== -1){
        	var imgstr = "";
        }else{
        	var imgstr = "<img src='"+n+"' width='100' /><br />";
        }
        var preView = '';
        if(/^videos(.*)/.test(returnid) != false)
        {
        	preView = '<a href="javascript:;" onClick="func_sys_VideoPreView(this)" style="margin-left:5px;">预览</a>';
        }
		str += "<li l='"+n+"' id='multifile"+ids+"' class='jsval_"+returnid+"' index='" + index + "'><img src='"+n+"' width='100' /><br /><input type='text' name='"+returnid+"_filewidth[]' value='" + tmp[0] + "' style='width: 30px;' class='input-text'><span>宽</span> <input type='text' name='"+returnid+"_fileheight[]' value='" + tmp[1] + "' style='width: 30px;' class='input-text'><span>高</span><input type='text' style='width:30px;margin-left:3px;' class='input-text' name='"+returnid+"_fileorder[]' /><span>显示顺序</span> <input type='text' name='"+returnid+"_fileduration[]' value='' style='width: 30px;' class='input-text'><span>时长</span>"+preView+"<br /><input type='text' name='"+returnid+"_filedes[]' value='' style='width: 486px;' class='input-text'> <span>标题</span><input type='text' name='"+returnid+"_fileurl[]' value='"+n+"' style='width:310px;' class='input-text'> <input type='text' name='"+returnid+"_filename[]' value='"+filename+"' style='width:160px;' class='input-text' onfocus=\"if(this.value == this.defaultValue) this.value = ''\" onblur=\"if(this.value.replace(' ','') == '') this.value = this.defaultValue;\"> <a href=\"javascript:remove_div('multifile"+ids+"')\">移除</a> <a href=\"javascript:add_content('multifile"+ids+"','"+returnid+"')\">添加到内容</a></li>";
		});

	$('#'+returnid).append(str);
}

// 图片内容预览
function func_sys_contentPreview(content,formid,dataid)
{
	var ajaxstr 	= '';
	var title 		= $('input[name="info[title]"]').val();
	var newstype 	= $('input[name="info[newstype]"]:checked').val();
	var keyword 	= $('input[name="info[keyword]"]').val();
	var copyfrom 	= $('input[name="info[copyfrom]"]').val();
	var showtype 	= $('input[name="info[showtype]:checked"]').val();
	var mycontent 	= CKEDITOR.instances.content.getData();
	var AjaxJson		= {
						"contentprevsubmit"	: 1,
						"data[title]"		: title,
						"data[newstype]"	: newstype,
						"data[showtype]"	: showtype,
						"data[keyword]"		: keyword,
						"data[copyfrom]"	: copyfrom,
					  };
	// 图片
	var piclen 		= $('input[name="pics_fileurl[]"]').length;
	if( piclen > 0 )
	{
		for(var p = 0; p < piclen; p++)
		{
			AjaxJson['data[pics][width]['+p+']']	= $('input[name="pics_filewidth[]"]').eq(p).val();
			AjaxJson['data[pics][height]['+p+']']	= $('input[name="pics_fileheight[]"]').eq(p).val();
			AjaxJson['data[pics][url]['+p+']']		= $('input[name="pics_fileurl[]"]').eq(p).val();
			AjaxJson['data[pics][summary]['+p+']']	= $('input[name="pics_filedes[]"]').eq(p).val();
			AjaxJson['data[pics][order]['+p+']']	= $('input[name="pics_fileorder[]"]').eq(p).val();
		}
	}
	var audiolen 	= $('input[name="audios_fileurl[]"]').length;
	if(audiolen > 0)
	{
		for(var a = 0; a < audiolen; a++)
		{
			AjaxJson['data[audios][width]['+a+']']	= $('input[name="audios_filewidth[]"]').eq(a).val();
			AjaxJson['data[audios][height]['+a+']']	= $('input[name="audios_fileheight[]"]').eq(a).val();
			AjaxJson['data[audios][url]['+a+']']	= $('input[name="audios_fileurl[]"]').eq(a).val();
			AjaxJson['data[audios][summary]['+a+']']= $('input[name="audios_filedes[]"]').eq(a).val();
			AjaxJson['data[audios][order]['+a+']']	= $('input[name="audios_fileorder[]"]').eq(a).val();
		}
	}
	var videolen	= $('input[name="videos_fileurl[]"]').length;
	if(videolen > 0)
	{
		for(var vdo = 0; vdo < videolen; vdo++)
		{
			AjaxJson['data[videos][width]['+vdo+']']	= $('input[name="videos_filewidth[]"]').eq(vdo).val();
			AjaxJson['data[videos][height]['+vdo+']']	= $('input[name="videos_fileheight[]"]').eq(vdo).val();
			AjaxJson['data[videos][url]['+vdo+']']		= $('input[name="videos_fileurl[]"]').eq(vdo).val();
			AjaxJson['data[videos][duration]['+vdo+']']	= $('input[name="videos_fileduration[]"]').eq(vdo).val();
			AjaxJson['data[videos][order]['+vdo+']']	= $('input[name="videos_fileorder[]"]').eq(vdo).val();		
		}
	}
	var vimglen 	= $('input[name="videoimgs_fileurl[]"]').length;
	if(vimglen > 0)
	{
		for(var vimg = 0; vimg < vimglen; vimg++)
		{
			AjaxJson['data[videos][width]['+vimg+']'] 	= $('input[name="videoimgs_filewidth[]"]').eq(vimg).val();
			AjaxJson['data[videos][height]['+vimg+']'] 	= $('input[name="videoimgs_fileheight[]"]').eq(vimg).val();
			AjaxJson['data[videos][url]['+vimg+']'] 	= $('input[name="videoimgs_fileurl[]"]').eq(vimg).val();
			AjaxJson['data[videos][summary]['+vimg+']']	= $('input[name="videoimgs_filedes[]"]').eq(vimg).val();
			AjaxJson['data[videos][order]['+vimg+']'] 	= $('input[name="videoimgs_fileorder[]"]').eq(vimg).val();
		}
	}
	AjaxJson['data[content]']	= mycontent;
	$.ajax({
			type: "POST",  
			url : '?m=content&c=newslibrary&a=add&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :AjaxJson,
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					$('#' + dataid).val(json.msg);
					$('#' + formid).submit();
				}
				else
				{
					alert(json.msg);
				}
			
			}
	});

	/*
	var ajaxstr 	= '';
	var title 		= $('input[name="info[title]"]').val();
	var newstype 	= $('input[name="info[newstype]"]:checked').val();
	var keyword 	= $('input[name="info[keyword]"]').val();
	var copyfrom 	= $('input[name="info[copyfrom]"]').val();
	var showtype 	= $('input[name="info[showtype]:checked"]').val();
	var mycontent 	= CKEDITOR.instances.content.getData();
	ajaxstr			= 'contentprevsubmit=1&data[title]=' + title + '&data[newstype]=' + newstype + '&data[showtype]=' + showtype + '&data[keyword]=' + keyword + '&data[copyfrom]=' + copyfrom;
	// 图片
	var piclen 		= $('input[name="pics_fileurl[]"]').length;
	if( piclen > 0 )
	{
		for(var p = 0; p < piclen; p++)
		{
			ajaxstr += '&data[pics][width][]=' + $('input[name="pics_filewidth[]"]').eq(p).val();
			ajaxstr += '&data[pics][height][]=' + $('input[name="pics_fileheight[]"]').eq(p).val();
			ajaxstr += '&data[pics][url][]=' + $('input[name="pics_fileurl[]"]').eq(p).val();
			ajaxstr += '&data[pics][summary][]=' + $('input[name="pics_filedes[]"]').eq(p).val();
			ajaxstr += '&data[pics][order][]=' + $('input[name="pics_fileorder[]"]').eq(p).val();
		}
	}
	var audiolen 	= $('input[name="audios_fileurl[]"]').length;
	if(audiolen > 0)
	{
		for(var a = 0; a < audiolen; a++)
		{
			ajaxstr += '&data[audios][width][]=' + $('input[name="audios_filewidth[]"]').eq(a).val();
			ajaxstr += '&data[audios][height][]=' + $('input[name="audios_fileheight[]"]').eq(a).val();
			ajaxstr += '&data[audios][url][]=' + $('input[name="audios_fileurl[]"]').eq(a).val();
			ajaxstr += '&data[audios][summary][]=' + $('input[name="audios_filedes[]"]').eq(a).val();
			ajaxstr += '&data[audios][order][]=' + $('input[name="audios_fileorder[]"]').eq(a).val();
		}
	}
	var videolen	= $('input[name="videos_fileurl[]"]').length;
	if(videolen > 0)
	{
		for(var vdo = 0; vdo < videolen; vdo++)
		{
			ajaxstr += '&data[videos][width][]=' + $('input[name="videos_filewidth[]"]').eq(vdo).val();
			ajaxstr += '&data[videos][height][]=' + $('input[name="videos_fileheight[]"]').eq(vdo).val();
			ajaxstr += '&data[videos][url][]=' + $('input[name="videos_fileurl[]"]').eq(vdo).val();
			ajaxstr += '&data[videos][duration][]=' + $('input[name="videos_fileduration[]"]').eq(vdo).val();
			ajaxstr += '&data[videos][order][]=' + $('input[name="videos_fileorder[]"]').eq(vdo).val();
		
		}
	}
	var vimglen 	= $('input[name="videoimgs_fileurl[]"]').length;
	if(vimglen > 0)
	{
		for(var vimg = 0; vimg < vimglen; vimg++)
		{
			ajaxstr += '&data[videoimgs][width][]=' + $('input[name="videoimgs_filewidth[]"]').eq(vimg).val();
			ajaxstr += '&data[videoimgs][height][]=' + $('input[name="videoimgs_fileheight[]"]').eq(vimg).val();
			ajaxstr += '&data[videoimgs][url][]=' + $('input[name="videoimgs_fileurl[]"]').eq(vimg).val();
			ajaxstr += '&data[videoimgs][summary][]=' + $('input[name="videoimgs_filedes[]"]').eq(vimg).val();
			ajaxstr += '&data[videoimgs][order][]=' + $('input[name="videoimgs_fileorder[]"]').eq(vimg).val();
		}
	}
	//ajaxstr 		+= '&data[content]=' + mycontent;
	ajaxstr 		= 'contentprevsubmit=1&data=' + mycontent;
	var myajx 		= {contentprevsubmit:1,'data[content]':mycontent,'a[0]':1,'a[1]':2};
	myajx['a[2]']	= '3';
	$.ajax({
			type: "POST",  
			url : '?m=content&c=newslibrary&a=add&pc_hash='+pc_hash,
			//dataType: "json",
			cache: false,
			//data :ajaxstr,
			data:myajx,
			success:function(json)
			{
				alert(json);
				if(json.statusCode == '200')
				{
					$('#' + dataid).val(json.msg);
					$('#' + formid).submit();
				}
				else
				{
					alert(json.msg);
				}
			
			}
	});
	*/
}

// 缩略图获取图片信息 缩略图片ID
function func_sys_thumbInfo(me,id)
{
	var imgurl 	= $('#' + id).val();
	if(imgurl == '')
	{
		alert('请上传缩略图');
		return false;
	}
	$.ajax({
			type: "POST",  
			url : '?m=content&c=compress&a=imginfo&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :{imgurl:imgurl},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					var str			= '图片信息:<br/>宽:'+json['data'].w+'&nbsp;高:'+ json['data'].h +'&nbsp;大小:'+json['data'].s+'K &nbsp;<br/>';	
					$(me).parent().parent().children(".jsval_info").html(str);
					//$(me).siblings(".jsval_compress").show();
					$(me).hide();
				}
				else
				{
					alert(json.msg);
				}
			}
	});
}

// 缩略图压缩 id:图片ID,imgtype:图片类型
function func_sys_thumbCompress(me,id,imgtype)
{
	var imgurl 	= $('#' + id).val();
	if(imgurl == '')
	{
		alert('请上传缩略图');
		return false;
	}
	$.ajax({
		    type: "POST",  
			url : '?m=content&c=compress&a=setimg&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :{imgurl:imgurl,imgtype:imgtype},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					var str	= '图片信息:<br/>宽:'+json['data'].w+'&nbsp;高:'+ json['data'].h +'&nbsp;大小:'+json['data'].s+'K &nbsp;<br/>'
					$('#' + id).val(json['data'].url);
					$('#' + id + '_preview').attr("src", json['data'].url);
					$(me).parent().parent().children(".jsval_info").html(str);
					$(me).siblings(".jsval_hfbtn").show();
					$(me).siblings(".jsval_infobtn").hide();
					$(me).hide();
				}
				else
				{
					alert(json.msg);
				}
	        }
	});
}

// 缩略图恢复原 id:图片地址ID
function func_sys_thumbRecover(me,id)
{
	var imgurl 	= $('#' + id).val();
	if(imgurl == '')
	{
		alert('请上传缩略图');
		return false;
	}
	$.ajax({
			type: "POST",  
			url : '?m=content&c=compress&a=imginfo&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :{imgurl:imgurl,recover:1},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					var str			= '图片信息:<br/>宽:'+json['data'].w+'&nbsp;高:'+ json['data'].h +'&nbsp;大小:'+json['data'].s+'K &nbsp;<br/>';	
					$(me).parent().parent().children(".jsval_info").html(str);
					$('#' + id).val(json['data'].url);
					$('#' + id + '_preview').attr("src", json['data'].url);
					$(me).hide();
					$(me).siblings(".jsval_infobtn").hide();
					$(me).siblings(".jsval_compress").show();
				}
				else
				{
					alert(json.msg);
				}
			}
	});
}

// 图集列表展示图片信息 me:this,inputname:URL文本框name
function func_sys_ListImgInfo(me,inputname)
{
	var imgurl 	= $(me).parent("span").parent("p").parent().children('input[name="'+inputname+'_fileurl[]"]').val();
	if(imgurl == '')
	{
		alert('图片不存在');
		return false;
	}
	$.ajax({
			type: "POST",  
			url : '?m=content&c=compress&a=imginfo&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :{imgurl:imgurl},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					var str			= '图片信息:<br/>宽:'+json['data'].w+'&nbsp;高:'+ json['data'].h +'&nbsp;大小:'+json['data'].s+'K &nbsp;<br/>';	
					$(me).parent().parent().children(".jsval_info").html(str);
					$(me).hide();
				}
				else
				{
					alert(json.msg);
				}
			}
	});
}

// 图集列表 图片压缩
function func_sys_ListImgCompress(me,inputname)
{
	var objpath		= $(me).parent("span").parent("p").parent();
	var imgurl		= objpath.children('input[name="'+inputname+'_fileurl[]"]').val();
	if(imgurl == '')
	{
		alert('图片不存在');
		return false;
	}
	var imgtype = 'pics';
	$.ajax({
			type: "POST",  
			url : '?m=content&c=compress&a=setimg&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :{imgurl:imgurl,imgtype:imgtype},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					var str	= '图片信息:<br/>宽:'+json['data'].w+'&nbsp;高:'+ json['data'].h +'&nbsp;大小:'+json['data'].s+'K &nbsp;<br/>';
					objpath.children('input[name="'+inputname+'_fileurl[]"]').val(json['data'].url);
					objpath.children('input[name="'+inputname+'_filewidth[]"]').val(json['data'].w);
					objpath.children('input[name="'+inputname+'_fileheight[]"]').val(json['data'].h);
					objpath.children("img").attr("src",json['data'].url);
					objpath.attr("l",json['data'].url);
					$(me).parent().parent().children(".jsval_info").html(str);
					$(me).siblings(".jsval_hfbtn").show();
					$(me).siblings(".jsval_infobtn").hide();
					$(me).hide();
					if(inputname == 'pics')
					{
						var myindex 	= objpath.attr("index");
						var cimg 		= '<img index="'+myindex+'" src="'+imgurl+'" />';
						var nimg 		= '<img index="'+myindex+'" src="'+json['data'].url+'" />';
						var mycontent 	= CKEDITOR.instances.content.getData();
						mycontent		= mycontent.replaceAll(cimg,nimg);
						CKEDITOR.instances.content.setData(mycontent);
					}
				}
				else
				{
					alert(json.msg);
				}
			}
	});
}

// 图集列表图片恢复 
function func_sys_ListImgRecover(me,inputname)
{
	var objpath		= $(me).parent("span").parent("p").parent();
	var imgurl		= objpath.children('input[name="'+inputname+'_fileurl[]"]').val();
	if(imgurl == '')
	{
		alert('请上传缩略图');
		return false;
	}
	$.ajax({
			type: "POST",  
			url : '?m=content&c=compress&a=imginfo&pc_hash='+pc_hash,
			dataType: "json",
			cache: false,
			data :{imgurl:imgurl,recover:1},
			success:function(json)
			{
				if(json.statusCode == '200')
				{
					var str			= '图片信息:<br/>宽:'+json['data'].w+'&nbsp;高:'+ json['data'].h +'&nbsp;大小:'+json['data'].s+'K &nbsp;<br/>';	
					objpath.children('input[name="'+inputname+'_fileurl[]"]').val(json['data'].url);
					objpath.children('input[name="'+inputname+'_filewidth[]"]').val(json['data'].w);
					objpath.children('input[name="'+inputname+'_fileheight[]"]').val(json['data'].h);
					objpath.children("img").attr("src",json['data'].url);
					objpath.attr("l",json['data'].url);
					$(me).parent().parent().children(".jsval_info").html(str);
					$(me).hide();
					$(me).siblings(".jsval_infobtn").hide();
					$(me).siblings(".jsval_compress").show();
					if(inputname == 'pics')
					{
						var myindex 	= objpath.attr("index");
						var cimg 		= '<img index="'+myindex+'" src="'+imgurl+'" />';
						var nimg 		= '<img index="'+myindex+'" src="'+json['data'].url+'" />';
						var mycontent 	= CKEDITOR.instances.content.getData();
						mycontent		= mycontent.replaceAll(cimg,nimg);
						CKEDITOR.instances.content.setData(mycontent);
					}
				}
				else
				{
					alert(json.msg);
				}
			}
	});
}

// 缩略图取消
function func_sys_thumbCancel(jsclass)
{
	var objcls 	= $('.' + jsclass);
	objcls.children(".jsval_info").html('');
	objcls.children(".jsval_btn").children(".jsval_infobtn").show();
	objcls.children(".jsval_btn").children(".jsval_compress").show();
	objcls.children(".jsval_btn").children(".jsval_hfbtn").hide();
}