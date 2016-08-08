<?php
	class GlobalController extends Zend_Controller_Action {
		public function init(){

		}
		
		public function okAction(){}
			
		public function errorAction(){}
		
		public function vainAction(){}

		public function topAction(){
			$system  = $_SESSION['system'];
			$account = $_SESSION['account'];
			$common  = new common();
			$info    = $common->findall($system,$account);
			if($system=="admin" && $info['admin_name']==""){
				$this->view->registrar = "管理员";
			}else{
				$this->view->registrar = $info[$system.'_name'];
			}
		}

		public function bottomAction(){}
		
		public function jumpinfoAction(){
			$system  = $_SESSION['system'];
			if($system=='student'){
				$this->_redirect('/information/information');
			}elseif($system=='teacher'){
				$this->_redirect('/teacherinfo/information');
			}elseif($system=='admin'){
				$this->_redirect('/admininfo/information');
			}
		}
		//获取key
		public function getkeyAction(){
			$system = $_SESSION['system'];
			$account = $_SESSION['account'];
			if($system && $account){
				if($system == 'student'){
					$student = new student();
					$student_info = $student->find_key($account);
					$key = $student_info['student_key'];
				}elseif($system == 'teacher') {
					$teacher = new teacher();
					$teacher_info = $teacher->get_teacher_info($account);
					$key = $teacher_info['teacher_key'];
				}
				echo $key;
				exit;
			}
		}
		//注销
		public function quitAction(){
			$_SESSION = array();
			session_destroy();	
		}
	
	
	}