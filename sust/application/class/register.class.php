<?php
	class myregister{
		public function register($data){
			$student = new StudentModel();
			$data = array(
				'student_account'=>$data['account'],
				'student_password'=>md5($data['password']),
				'student_name'    =>$data['name'],
				);
			$register_res = $student->insert($data);
			return $register_res;
		}




	}