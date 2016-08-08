<?php
	class StudentController extends Zend_Controller_Action{
		public function init(){
			$this->is_login('student');
		}
		
		public function studentAction(){}

		public function leftAction(){}
			
		public function rightAction(){
			$student = new student();
			$account = $_SESSION['account'];
			$student_info = $student->find_key($account);
			if($student_info && $student_info['student_key']==0){
				$this->_forward('info','information');
			}else{
				$this->_forward('information','information');
			}
		}
				
	}
