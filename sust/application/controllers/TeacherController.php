<?php
	class TeacherController extends Zend_Controller_Action {
		public function init(){
			$this->is_login('teacher');
		}
		
		public function teacherAction(){}
				
		public function leftAction(){}
		
		public function rightAction(){
			$teacher = new teacher();
			$account = $_SESSION['account'];
			$teacher_info = $teacher->get_teacher_info($account);
			if($teacher_info && $teacher_info['teacher_key']==0){
				$this->_forward('info','Teacherinfo');
			}else{
				$this->_forward('information','Teacherinfo');
			}
		}
		
		
	}
