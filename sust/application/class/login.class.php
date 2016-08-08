<?php
	class login{
		//检查账号是否存在
		public function check_in($radio,$account){
			switch ($radio) {
				case 'student':
					$studentModel = new StudentModel();
					$db=$studentModel->getAdapter();
					$where=$db->quoteInto("student_account=?","$account");
					$row=$studentModel->fetchRow($where);
					break;
				case 'teacher':
					$teacherModel = new TeacherModel();
					$db=$teacherModel->getAdapter();
					$where=$db->quoteInto("teacher_account=?","$account");
					$row=$teacherModel->fetchRow($where);
					break;
				case 'admin':
					$adminModel = new AdminModel();
					$db=$adminModel->getAdapter();
					$where=$db->quoteInto("admin_account=?","$account");
					$row=$adminModel->fetchRow($where);
					break;				
				default:
					break;
			}
				return $row;
		}

		//验证账号密码
		public function check($radio,$account,$password){
			$data_obj = $this->check_in($radio,$account);
			if ($data_obj != NULL) {
				if($data_obj[$radio."_password"] == md5($password)){
					return $data_obj;
				}
			}
			return false;
		}

		//检验身份证号是否对应
		public function check_personid($data){
				$studentModel = new StudentModel();
				$db = $studentModel->getAdapter();
				$where = $db->quoteInto("student_account=?",$data['account']);
				$student_info = $studentModel->fetchRow($where);
				if($student_info != NULL){
					if($student_info['student_personID'] == $data['personId']){
						return true;
					}
				}
				return false; 
		}

	}