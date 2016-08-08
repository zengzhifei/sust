<?php
	class student{
		public function find_key($account){
			$student = new StudentModel();
			$db = $student->getAdapter();
			$where = $db->quoteInto('student_account=?',$account);
			$student_res = $student->fetchRow($where);
			return $student_res;	
		}
		//查找所有学生
		public function find_all(){
			$student = new StudentModel();
			$students = $student->fetchAll()->toArray();
			return $students;
		}



	}