<?php
	class teacher{
		public function get_teachers(){
			$teacher = new TeacherModel();
			$teachers = $teacher->fetchAll()->toArray();
			return $teachers;
		}
		public function get_teacher_info($account){
			$teacher = new TeacherModel();
			$db = $teacher->getAdapter();
			$where = $db->quoteInto('teacher_account=?',$account);
			$teacher_info = $teacher->fetchRow($where);
			return $teacher_info;
		}




	}