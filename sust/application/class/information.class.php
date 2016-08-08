<?php
	class information{
		//学生信息完善
		public function complete($data){
			$student = new StudentModel();
			$db = $student->getAdapter();
			$set = array(
						 'student_name'=>$data['name'],
						 'student_account'=>$data['account'],
						 'student_personID'=>$data['personID'],
						 'student_sex'=>$data['sex'],
						 'student_address'=>$data['address'],
						 'student_nation'=>$data['nation'],
						 'student_member'=>$data['member'],
						 'student_hostel'=>$data['hostel'],
						 'student_note'=>$data['remark'],
						 'student_key'=>1,
				);
			foreach ($set as $key => $value) {
				if(!$value){
					unset($set[$key]);
				}
			}
			$where = $db->quoteInto('student_account=?',$data['account']);
			$complete_res = $student->update($set,$where);
			return $complete_res;
		}
		//取出学生信息
		public function get_info($account){
			$student = new StudentModel();
			$db = $student->getAdapter();
			$where = $db->quoteInto('student_account=?',$account);
			$info = $student->fetchRow($where);
			return $info;
		}
		//完善教师信息
		public function complete_teacher($data){
			$teacher = new TeacherModel();
			$db = $teacher->getAdapter();
			$set = array(
						 'teacher_name'=>$data['name'],
						 'teacher_account'=>$data['account'],
						 'teacher_phone'=>$data['phone'],
						 'teacher_email'=>$data['email'],
						 'teacher_key'=>1,
				);
			foreach ($set as $key => $value) {
				if(!$value){
					unset($set[$key]);
				}
			}
			$where = $db->quoteInto('teacher_account=?',$data['account']);
			$complete_res = $teacher->update($set,$where);
			return $complete_res;
		}
	

	}

