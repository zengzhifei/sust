<?php
	class AdmininfoController extends Zend_Controller_Action{
		public function init(){
			$this->is_login('admin');
			$this->common = new common();
		}

		//查找个人信息
		public function informationAction(){
			$account=$_SESSION['account'];
			$info = $this->common->findall('admin',$account);
			$this->view->account = $info['admin_account'];
			$this->view->name = $info['admin_name'];
			$this->view->phone = $info['admin_phone'];
			$this->view->email = $info['admin_email'];
		}
		//更新信息
		public function updateadminAction(){
			//禁止渲染视图
			$this->_helper->viewRenderer->setNoRender();
			$oldDate = $_POST;
			$data = $this->common->filter($oldDate);
			if(!$data['account']){
				echo 404;
				exit;
			}
			$admin = new admin();
			$update_res = $admin->update("admin",$data);
			if($update_res){
					echo $data['value'];
			}else{
					echo false;
			}
		}
		
	}

