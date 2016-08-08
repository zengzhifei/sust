<?php
	class admin{
		//添加 $data:数据数组
		public function add($table_name,$data){
			switch ($table_name) {
				case 'teacher':
					$addobjModel = new TeacherModel();
					$data=array(
						'teacher_name'=>$data['name'],
						'teacher_account'=>$data['account'],
						'teacher_password'=>md5($data['password']),
					);
					break;
				case 'student':
					$addobjModel = new StudentModel();
					break;
				default:
					return;
					break;
			}
			$add_res = $addobjModel -> insert($data);
			return $add_res;
		}

		//删除
		public function delete($table_name,$account){
				switch ($table_name) {
					case 'student':
						$deleteobjModel = new StudentModel();
						break;
					case 'teacher':
						$deleteobjModel = new TeacherModel();						
						break;
					default:
						return;
						break;
				}
				$db = $deleteobjModel->getAdapter();
				$where=$db->quoteInto($table_name.'_account=?',$account);
				$delete_res = $deleteobjModel->delete($where);
				return $delete_res;
		}

		//更新 $needata:数据数组
		public function update($table_name,$data){
			switch ($table_name) {
				case 'teacher':
					$updateobjModel = new TeacherModel();
					break;
				case 'student':
					$updateobjModel = new StudentModel();
					break;
				case 'admin':
					$updateobjModel = new AdminModel();
					break;
				default:
					return;
					break;
			}
			$db = $updateobjModel->getAdapter();
			$set = array(
					$data['name']=>$data['value'],
				);
			$where = $db->quoteInto($table_name.'_account = ?', $data['account']);
			$update_res = $updateobjModel->update($set,$where);
			return $update_res;	
		}
		
		//查找相关信息
		public function find($table_name,$keyWord){
				$findword = "%$keyWord%";
				switch ($table_name) {
					case 'student':
						$findobjModel = new StudentModel();
						$db = $findobjModel->getAdapter();
						$where    = $db->quoteInto($table_name.'_name like ? OR ',"$findword").
									$db->quoteInto($table_name.'_account like ? OR ',"$findword").
									$db->quoteInto($table_name.'_id like ? OR ',"$findword").
									$db->quoteInto($table_name.'_personID like ? OR ',"$findword").
									$db->quoteInto($table_name.'_sex like ? OR ',"$findword").
									$db->quoteInto($table_name.'_address like ? OR ',"$findword").
									$db->quoteInto($table_name.'_nation like ? OR ',"$findword").
									$db->quoteInto($table_name.'_member like ? OR ',"$findword").
									$db->quoteInto($table_name.'_hostel like ? OR ',"$findword").
									$db->quoteInto($table_name.'_key like ?',"$findword");
						break;
					case 'teacher':
						$findobjModel = new TeacherModel();
						$db = $findobjModel->getAdapter();
						$where    = $db->quoteInto($table_name.'_name like ? OR ',"$findword").
									$db->quoteInto($table_name.'_account like ? OR ',"$findword").
									$db->quoteInto($table_name.'_id like ? OR ',"$findword").
									$db->quoteInto($table_name.'_phone like ? OR ',"$findword").
									$db->quoteInto($table_name.'_email like ? OR ',"$findword").
									$db->quoteInto($table_name.'_key like ?',"$findword");
						break;
					default:
						return;
						break;
				}
				$order   = $table_name.'_id';
				$find_res = $findobjModel->fetchAll($where,$order)->toArray();
				return $find_res;
		}

	}