<?php
	class OtherController extends Zend_Controller_Action {
		public function init(){
			$this->is_login('student');
			$this->file = new file();
		}

		//修改密码页面
		public function modifyAction(){			
			$this->view->account = $_SESSION['account'];	
		}

		//检验旧密码是否正确
		public function checkoldpswAction(){
			$oldData = $_POST;
			$common = new common();
			$data = $common->filter($oldData);
			$login = new login();
			$check_res = $login->check('student',$data['account'],$data['oldpassword']);
			if($check_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}

		//修改密码
		public function modifypasswordAction(){
			$oldData = $_POST;
			$common = new common();
			$data = $common->filter($oldData);
			if(!$data['newpassword']){
				echo false;
				exit;
			}
			$modify_res = $common->modify_password('student',$data);
			if($modify_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}
		
		//查看上传资料
		public function downloadinfoAction(){
			$files = $this->file->get_file();
			foreach($files as $key => $file) {
				$files[$key]['files_time'] = date("Y-m-d H:i:s",$file['files_time']);
			}
			$this->view->fileinfo = $files;
			$this->render('download');	
		}
		
		//下载
		public function downloadAction(){
			header("Content-type:text/html;charset=utf-8");
			$path     = $this->getRequest()->getParam("path");
			$fileName = $this->getRequest()->getParam("fileName");
			$suffix = substr($path,strrpos($path,'.'));
			$down_name = $fileName.$suffix;
			$down_name = iconv("utf-8", "GB2312//IGNORE",$down_name);
			$path = iconv("utf-8", "GB2312//IGNORE",$path);
			if(!file_exists($path)){
				exit("文件不存在,可能已被删除");
 			} 
 			$this->file->download($down_name,$path);
		}
		
	}

