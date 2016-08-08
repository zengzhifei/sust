<?php
	class CourseinfoController extends Zend_Controller_Action {
		public function init(){
			$this->is_login('teacher');
			$this->course = new course();
		}
		//课程人数	
		public function numberAction(){
			$courses = $this->course->get_course();
			foreach ($courses as $key => $mycourse) {
				$number_res = $this->course->get_number($mycourse['course_id']);
				$course_info = array('course_id'=>$mycourse['course_id'],'course_name'=>$mycourse['course_name'],'course_number'=>count($number_res));
				$number_info[] = $course_info;
			}
			$this->view->courseinfo = $number_info;
			$this->render('coursenum');
		}
		
		//上课时间
		public function timeAction(){	
			$this->render('coursetime');
		}
		
		//分配上课时间
		public function distributetimeAction(){
			$oldData = $_POST;
			$common = new common();
			$data = $common->filter($oldData);		
			for ($i=1;$i<=5;$i++){
				for ($j=1;$j<=5;$j++){
					$k=$j.$i;
					$course_name = $data["$k"];
					$course_name = $course_name?$course_name:'休息';
					$newdata=array(
							'courseTime_ctime'=>$k,
							'courseTime_courseName'=>$course_name,
							'courseTime_term'=>date('Ym'),
						);
					$display_res = $this->course->display_coursetime($newdata);
					$display[] = $display_res?true:false;
				}
			}
			foreach ($display as $key => $value){
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
			$course_info = $this->course->get_curriculum();
			$this->view->curriculum = $course_info;
		}
		
		//修改课程分配时间
		public function modifytimeAction(){
			$oldData = $_POST;
			$common = new common();
			$data = $common->filter($oldData);
			$courseTime_courseName = $data['courseTime_courseName']?$data['courseTime_courseName']:'休息';
			$update_res = $this->course->update_curriculum($data);
			if($update_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}

	}
