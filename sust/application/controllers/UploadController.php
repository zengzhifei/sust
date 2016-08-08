<?php
	class UploadController extends Zend_Controller_Action 
	{ 
		public function init(){
			$this->is_login('teacher');
			$this->file = new file();
		}
		//上传文件页面
		public function uploaduiAction(){
			$this->render('upload');
		}
		
		//上传文件
		public function uploadAction(){
			$oldData = $_POST;
			$common = new common();
			$data = $common->filter($oldData);
			$account = $_SESSION['account'];//上传人id
			$teacher = new teacher();	
			$teacher_info = $teacher->get_teacher_info($account);
			//设置文件大小
			$file_size = $_FILES['myfile']['size'];
			if ($file_size>2*1024*1024){
				echo 500;
				exit;
			}
			//检验是否临时上传成功
			if (is_uploaded_file($_FILES['myfile']['tmp_name'])){
				$up_load   = $_FILES['myfile']['tmp_name'];
				$user_path = $_SERVER['DOCUMENT_ROOT']."/file/".$account;
				//创建目录
				if(!file_exists($user_path)){
					mkdir($user_path);
				}
				//转移文件
				$mova_to_load = $user_path."/".date("Y-m-d_H-i-s")."_".$_FILES['myfile']['name'];				
				//转移成功，上传到数据库
				if (move_uploaded_file($up_load,iconv("utf-8","gb2312",$mova_to_load))){
					$file = new file();
					$data = array(
						'fileName' => $data['mainTitle'],
						'author'   => $teacher_info['teacher_name'],
						'fileIntro'=> $data['fileIntroduce'],
						'path'     => $mova_to_load,
						);
					$upload_res = $this->file->upload($data);
					if ($upload_res){
						$this->view->tip = "上传成功";
						$this->view->address = "/Upload/uploadui";
						$this->_forward('ok','Global');
						return;
					}	
				}
			}
				$this->view->tip = "上传失败！重新上传";
				$this->_forward('error','Global');
		}
		
		//查看上传资料
		public function getfileAction(){
			$file_info = $this->file->get_file();
			foreach ($file_info as $key => $file) {
				$file_info[$key]['files_time'] = date("Y-m-d H:i:s",$file['files_time']);
			}
			$this->view->fileinfo = $file_info;
		}

		//删除文件
		public function deletefileAction(){
			header("Content-type:text/html;charset=utf-8");
			$fileid = $this->getRequest()->getParam('fileid');
			$file_info = $this->file->get_file_info($fileid);
			$file_path = $file_info['files_path'];
			$file_path = iconv("utf-8", "GB2312//IGNORE",$file_path);
			if(!$file_path){
				echo 404;
				exit;
			}
			$delete = @unlink($file_path);
			if($delete){
				$delete_res = $this->file->delete_file($fileid);
				if($delete_res){
					echo true;
					exit;
				}	
			}
			echo false;
			exit;
		}
	}
