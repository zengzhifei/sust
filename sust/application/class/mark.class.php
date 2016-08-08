<?php
	class mark{
		//打分
		public function do_mark($data){
			$selectCourse = new SelectcourseModel();
			$db = $selectCourse->getAdapter();
			$set = array(
					'selectCourse_grade' => $data['grade'],	
					'selectCourse_credit'=> $data['credit'],	
				);
			$where = $db->quoteInto('selectCourse_sid=?',$data['sid']).
						$db->quoteInto(' AND selectCourse_cid=?',$data['cid']);	
			$row = $selectCourse->update($set, $where);
			return $row;
		}

		//查看对应学生的成绩
		public function get_mark($account){
			$selectCourse = new SelectcourseModel();
			$db = $selectCourse->getAdapter();
			$where = $db->quoteInto('selectCourse_sid=?',$account);
			$get_res = $selectCourse->fetchAll($where)->toArray();
			return $get_res;
		}




	}
