<?php
	class TeacherinfoController extends Zend_Controller_Action{
		public function init(){
			$this->is_login('teacher');
			$this->common = new common();
		}

		public function infoAction(){
			$account = $_SESSION['account'];
			$info = $this->common->findall('teacher',$account);
			$name = $info['teacher_name'];
			$this->view->name = $name;
			$this->view->account = $account;
		}

		public function completeAction(){
			//接收信息
			$oldData = $_POST;
			$data = $this->common->filter($oldData);
			$information = new information();
			$complete_res = $information->complete_teacher($data);
			if($complete_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}

		//查找个人信息
		public function informationAction(){
			$account=$_SESSION['account'];
			$info = $this->common->findall('teacher',$account);
			$this->view->account = $info['teacher_account'];
			$this->view->name = $info['teacher_name'];
			$this->view->phone = $info['teacher_phone'];
			$this->view->email = $info['teacher_email'];
		}
		
	}

