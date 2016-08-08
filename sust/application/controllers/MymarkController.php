<?php
	class MymarkController extends Zend_Controller_Action  {
			public function init(){
				$this->is_login('student');
				$this->mark = new mark();
			}
			
			//查看成绩
			public function mymarkAction(){
				$account=$_SESSION['account'];
				$mark_info = $this->mark->get_mark($account);
				$course = new course();
				foreach ($mark_info as $key => $mycourse) {
					$course_info = $course->get_course_info($mycourse['selectCourse_cid']);
					$coursesName[] = $course_info['course_name'];
					$coursesMark[] = $mycourse['selectCourse_grade'];
					$coursesCredit[] = $mycourse['selectCourse_credit'];
				}
				//分配科目名字
				$this->view->coursesName = $coursesName;
				//分配科目分数
				$this->view->marks = $coursesMark;
				//分配学分
				$this->view->credits = $coursesCredit;		
			}
		
	}
