<?php
	class SelectcourseController extends Zend_Controller_Action {	
			public function init(){
				$this->is_login('student');
				$this->course = new course();
			}
			//进入选课
			public function selectcourseAction(){	
				//查找所有课程
				$account=$_SESSION['account'];
				$course_res = $this->course->get_course();
				//查找已选课程
				$select_course_res = $this->course->get_select_course($account); 
				//删除已选课程
				foreach ($select_course_res as $val){
					$cidkey[] = $val['selectCourse_cid'];
				}
				foreach ($course_res as $key => $value) {
					if(in_array($value['course_id'], $cidkey)){
						unset($course_res[$key]);
					}
				}
				//分配未选课程数组
				$this->view->Courses = $course_res;
			}
		
			//提交选课
			public function selectAction(){		
				//接收数据
				$account = $_SESSION['account'];
				$courses = $this->getRequest()->getParam("select");
				for($i=0;$i<count($courses);$i++){
					$data = array('sid'=>$account,'cid'=>$courses[$i],'credit'=>0);
					if($this->course->select_course($data)>0){
						$select_res[] = true;
					}else{
						$select_res[] = false;
					}
				}
				foreach ($select_res as $key => $value) {
					if(!$value){
						echo false;
						exit;
					}
				}
				echo true;
				exit;
			}
		
			//选课结果
			public function selectresultAction(){
				//查找已选课程
				$account=$_SESSION['account'];
				$select_courses = $this->course->get_select_course($account);
				foreach ($select_courses as $key => $course) {
					$courses[] = $this->course->get_course_info($course['selectCourse_cid']);
				}
				$this->view->myCourses = $courses;
				$this->render('mycourses');
			}
			
			//删除已选课程
			public function delcourseAction(){
				//接收数据
				$account = $_SESSION['account'];
				$del_courses = $this->getRequest()->getParam("del");
				for($i=0;$i<count($del_courses);$i++){
					$data = array('sid'=>$account,'cid'=>$del_courses[$i]);
					if($this->course->del_course($data)>0){
						$del_res[] = true;
					}else{
						$del_res[] = false;
					}
				}
				foreach ($del_res as $key => $value) {
					if(!$value){
						echo false;
						exit;
					}
				}
				echo true;
				exit;
			}

			//查看分配课程表
			public 	function curriculumAction(){
				$course_info = $this->course->student_get_curriculum();
				$this->view->curriculum = $course_info;
			}
			
			
	}


