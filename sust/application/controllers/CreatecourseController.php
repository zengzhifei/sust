<?php
	class CreatecourseController extends Zend_Controller_Action {
		public function init(){
			$this->is_login('teacher');
			$this->course = new course();
		}
		
		//添加课程页面
		public function addcourseuiAction(){
			$term = (date("m")>=2 && date("m")<=7)?"第二学期":"第一学期";
			$year = date("Y");
			$now  = ($year-1)."-".$year."学年".$term;
			$this->view->now = $now;                         //学年
		}
		
		//创建课表
		public function addcourseAction(){
			$this->_helper->viewRenderer->setNoRender();
			$oldData = $_POST;
			$common = new common();
			$courses = $common->filter($oldData);
			$date = date("Ym");
			$data = array();
			$temp = 0;
			$num  = 1;	
			foreach ($courses as $key => $value) {
				if($temp>0){
					--$temp;
				}else{
					if($num%2 == 0){
						$data['course_credit'] = $value?$value:0;
						$data['course_term'] = $date;
						$add_res = $this->course->add_course($data);
						$res[] = $add_res?true:false;
					}else{
						if($value){
							$data['course_name'] = $value;
						}else{
							++$temp;
						}
					}
				}
				++$num;
			}
			foreach ($res as $key => $value){
				if($value==false){
					echo 500;
					return;
				}
			}
			echo true;		
		}

		//修改课程页面
		public function altercourseuiAction(){
			$courses = $this->course->get_course();
			$this->view->courses = $courses;
		}

		//删除课程
		public function deletecourseAction(){
			$data = $_POST;
			$delete_res = $this->course->delete_course($data);
			if($delete_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}


	}
	