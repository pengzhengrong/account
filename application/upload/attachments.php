<?php 
class attachments {
	
	/**
	 * swfupload上传附件
	 */
	public static function swfupload(){
		if( isset( $_REQUEST['dosubmit']) ){
			print_r($_FILES);
		}
		session_id();
		session_start();
		echo $_COOKIE['test'];
		@error_log("\n test=".$_COOKIE['test'],3,"/tmp/pzrlog.log");
		ROOT::load_tpl( 'swfupload' );
	}
	
	
 	/* public function swfupload(){
		$grouplist = getcache('grouplist','member');
		if(isset($_POST['dosubmit'])){
			//判断是否登录
			//if(empty($this->userid)){
			//	exit('0');
				//}
	
	//验证格式
				if( $_POST['swf_auth_key'] != md5(pc_base::load_config('system','auth_key').$_POST['SWFUPLOADSESSID']) || ($_POST['isadmin']==0 && !$grouplist[$_POST['groupid']]['allowattachment'])) exit();
	//加载attachment文件
				pc_base::load_sys_class('attachment','',0);
	//初始化attachment构造函数
				$attachment = new attachment($_POST['module'],$_POST['catid'],$_POST['siteid']);
	//设置userid
				$attachment->set_userid($_POST['userid']);
	//上传，存入db
				$aids = $attachment->upload('Filedata',$_POST['filetype_post'],'','',array($_POST['thumb_width'],$_POST['thumb_height']),$_POST['watermark_enable']);
				//验证上传文件格式是否合规
				$siteid = get_siteid();
				$site_setting = get_site_setting($siteid);
				$site_allowext = $site_setting['upload_allowext'];
				$allowext_array = explode('|',$site_allowext);
				if(!in_array($attachment->uploadedfiles[0]['fileext'],$allowext_array)){
					exit('0');
				}
				if($aids[0]) {
					$filename= (strtolower(CHARSET) != 'utf-8') ? iconv('gbk', 'utf-8', $attachment->uploadedfiles[0]['filename']) : $attachment->uploadedfiles[0]['filename'];
					if ( $attachment->uploadedfiles[ 0 ][ 'isimage' ] ) {
						$source = $attachment->upload_root . $attachment->uploadedfiles[ 0 ][ 'filepath' ];
						$result = getimagesize( $source );
						$w = $result[ 0 ];
						$h = $result[ 1 ];
						echo $aids[ 0 ] . ',' . '/uploadfile/' . $attachment->uploadedfiles[ 0 ][ 'filepath' ] . ',' . $attachment->uploadedfiles[ 0 ][ 'isimage' ] . ',' . $filename . ",{$w}, {$h}, {$source}";
					} else {
						$fileext = $attachment->uploadedfiles[0]['fileext'];
						if($fileext == 'zip' || $fileext == 'rar') $fileext = 'rar';
						elseif($fileext == 'doc' || $fileext == 'docx') $fileext = 'doc';
						elseif($fileext == 'xls' || $fileext == 'xlsx') $fileext = 'xls';
						elseif($fileext == 'ppt' || $fileext == 'pptx') $fileext = 'ppt';
						elseif ($fileext == 'flv' || $fileext == 'swf' || $fileext == 'rm' || $fileext == 'rmvb') $fileext = 'flv';
						else $fileext = 'do';
						echo $aids[0].','.'/uploadfile/'.$attachment->uploadedfiles[0]['filepath'].','.$fileext.','.$filename;
					}
					exit;
				} else {
					echo '0,'.$attachment->error();
					exit;
				}
	
			} else {
				if($this->isadmin==0 && !$grouplist[$this->groupid]['allowattachment']) showmessage(L('att_no_permission'));
				$args = $_GET['args'];
				$authkey = $_GET['authkey'];
				if(upload_key($args) != $authkey) showmessage(L('attachment_parameter_error'));
				extract(getswfinit($_GET['args']));
				$siteid = $this->get_siteid();
				$site_setting = get_site_setting($siteid);
				$file_size_limit = sizecount($site_setting['upload_maxsize']*1024);
				$att_not_used = param::get_cookie('att_json');
				if(empty($att_not_used) || !isset($att_not_used)) $tab_status = ' class="on"';
				if(!empty($att_not_used)) $div_status = ' hidden';
				//获取临时未处理文件列表
				$att 	= $this->att_not_used();
				if(!empty($att) && is_array($att))
				{
					foreach($att as $_kk=>$_vv)
					{
						$att[$_kk]['fileimg']	= preg_replace('/^(.*)(\/uploadfile\/)(.*)/', '\\2\\3', $_vv['fileimg']);
						$att[$_kk]['src']	= preg_replace('/^(.*)(\/uploadfile\/)(.*)/', '\\2\\3', $_vv['src']);
					}
				}
	
				include $this->admin_tpl('swfupload');
			}
		}  */
}
?>
