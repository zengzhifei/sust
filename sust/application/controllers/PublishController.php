<?php
	class PublishController extends Zend_Controller_Action{
		public function init(){
			$this->is_login('admin');
			$this->publish = new publish();
		}

		public function releaseAction(){}

		//保存通知
		public function publishAction(){
			$oldData = $_POST;
			$common  = new common();
			$data    = $common->filter($oldData);
			$account  = $_SESSION['account'];
			$info     = $common->findall('admin',$account);
			$author   = $info['admin_name'];
			$data['author'] = $author;
			if($data['title']){
				$publish_res = $this->publish->do_publish($data);
				if($publish_res){
					echo true;
				}else{
					echo false;
				}
				exit;
			}else{
				echo 404;
				exit;
			}
		}

		//查看通知
		public function getreleaseAction(){
			$releases_info = $this->publish->get_publish();
			$this->view->releases = $releases_info;
		}

		//删除通知
		public function deletepublishAction(){
			$publish_id = $this->getRequest()->getParam('releaseid');
			if($publish_id){
				$delete_res = $this->publish->delete_publish($publish_id);
				if($delete_res){
					echo true;
				}else{
					echo false;
				}
				exit;
			}else{
				echo 404;
				exit;
			}
		}


	}


