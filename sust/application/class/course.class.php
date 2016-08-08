<?php
	class course{
		//添加课程
		public function add_course($data){
			$courseModel = new CourseModel();
			$data = array(
					"course_name"   => $data['course_name'],
					"course_credit" => $data['course_credit'],
					"course_term"   => $data['course_term'],
				);
			$add_res = $courseModel->insert($data);
			return $add_res;
		}
		//查看所有课程
		public function get_course(){
			$courseModel = new CourseModel();
			$db = $courseModel->getAdapter();
			$where = $db->quoteInto("course_term >= ?",(int)date('Ym')-2).
					$db->quoteInto(" AND course_term <= ?",(int)date("Ym")+3);
			$get_res = $courseModel->fetchAll($where)->toArray();
			return $get_res;
		}
		//删除课程
		public function delete_course($data){
			$courseModel = new CourseModel();
			$db = $courseModel->getAdapter();
			$where = $db->quoteInto("course_id=?",$data['course_id']);
			$delete_res = $courseModel->delete($where);
			return $delete_res;
		}
		//查看课程信息
		public function get_course_info($cid){
			$courseModel = new CourseModel();
			$db = $courseModel->getAdapter();
			$where = $db->quoteInto('course_id=?',$cid);
			$get_res = $courseModel->fetchRow($where);
			return $get_res;
		}
		//查看已选课程
		public function get_select_course($account){
			$selectcourseModel = new SelectcourseModel();
			$db = $selectcourseModel->getAdapter();
			$where = $db->quoteInto('selectCourse_sid=?',"$account");
			$get_select_res = $selectcourseModel->fetchAll($where)->toArray();
			return $get_select_res;
		}
		//选课
		public function select_course($data){
			$selectCourse = new SelectcourseModel();
			$data = array(
					'selectCourse_sid' => $data['sid'],
					'selectCourse_cid' => $data['cid'],
					'selectCourse_credit' => $data['credit'],
				);
			$select_res = $selectCourse->insert($data);
			return $select_res;
		}
		//删除选课
		public function del_course($data){
			$selectCourse = new SelectcourseModel();
			$db = $selectCourse->getAdapter();
			$where = $db->quoteInto('selectCourse_sid=?',$data['sid']).
					 $db->quoteInto(' AND selectCourse_cid=?',$data['cid']);
			$del_res = $selectCourse->delete($where);
			return $del_res;
		}
		//查看选课人数
		public function get_number($course_cid){
			$selectCourse = new SelectcourseModel();
			$db = $selectCourse->getAdapter();
			$where = $db->quoteInto("selectCourse_cid = ?",$course_cid);
			$number_res = $selectCourse->fetchAll($where)->toArray();
			return $number_res;
		}
		//分配课程时间
		public function display_coursetime($data){
			$coursetime = new CoursetimeModel();
			$row=$coursetime->insert($data);
			return $row;
		}
		//查看课程时间
		public function get_curriculum(){
			$coursetime = new CoursetimeModel();
			$db = $coursetime->getAdapter();
			$where = $db->quoteInto("courseTime_term >= ?",(int)date('Ym')-2).
					$db->quoteInto(" AND courseTime_term <= ?",(int)date("Ym")+3);
			for ($i=0;$i<5;$i++){				
					$count = 5;
					$offset = $i*5;
					$course = $coursetime->fetchAll($where,null,$count,$offset)->toArray();
					$courses[]=$course;
			}
			return $courses;
		}
		//学生查看课程时间
		public function student_get_curriculum(){
			$coursetime = new CoursetimeModel();
			for ($i=0;$i<5;$i++){				
					$count = 5;
					$offset = $i*5;
					$course = $coursetime->fetchAll(null,null,$count,$offset)->toArray();
					for ($j=0; $j < 5; $j++) { 
						if($course[$j]["courseTime_courseName"]==="休息"){
							$course[$j]["courseTime_courseName"]="";
						}
					}
					$courses[]=$course;
			}
			return $courses;
		}
		//更新课程时间
		public function update_curriculum($data){
			$coursetime = new CoursetimeModel();
			$db = $coursetime -> getAdapter();
			$set = array(
					'courseTime_courseName'=>$data['courseTime_courseName'],
				);
			$where = $db->quoteInto('courseTime_id=?',$data['courseTime_id']);
			$row = $coursetime->update($set,$where);
			return $row;
		}
		
	}