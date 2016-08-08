<?php
	class file{
		public function upload($data){
			$file = new FileModel();
			$data = array(
					'files_fileName'   => $data['fileName'],
					'files_authorName' => $data['author'],
					'files_intro'      => $data['fileIntro'],
					'files_path'       => $data['path'],
					'files_time'       => time(),
				);
			$upload_res = $file->insert($data);
			return $upload_res;
		}
		//查看文件
		public function get_file(){
			$fileModel = new FileModel();
			$file_info = $fileModel->fetchAll()->toArray();
			return $file_info;
		}
		//删除文件
		public function delete_file($fileid){
			$fileModel = new FileModel();
			$db = $fileModel->getAdapter();
			$where = $db->quoteInto("files_id=?",$fileid);
			$delete_res = $fileModel->delete($where);
			return $delete_res;
		}
		//下载文件
		public function download($down_name,$path){
			header("Content-type:text/html;charset=utf-8");
			$fp = fopen($path,"r");
 			$file_size = filesize($path);
 			header("Content-type: application/octet-stream");
 			header("Accept-Ranges: bytes");
 			header("Accept-Length:".$file_size);
 			header("Content-Disposition: attachment; filename=".$down_name);
 			$buffer = 1024;
 			$file_count = 0;
			while(!feof($fp) && $file_count < $file_size){
				  $file_con = fread($fp,$buffer);
				  $file_count += $buffer;
				  echo $file_con;
			 } 
			 fclose($fp);
			 exit();
		}
		//取出文件信息
		public function get_file_info($fileid){
			$fileModel = new FileModel();
			$db = $fileModel->getAdapter();
			$where = $db->quoteInto("files_id=?",$fileid);
			$file_info = $fileModel->fetchRow($where);
			return $file_info;
		}
	}