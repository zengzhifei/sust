<?php
	class common{
		//检验账号是否存在
		public function check_exist($table_name,$account){
			switch ($table_name) {
				case 'student':
					$checkobj = new StudentModel();
					$db = $checkobj->getAdapter();
					break;
				case 'teacher':
					$checkobj = new TeacherModel();
					$db = $checkobj->getAdapter();
					break;
				default:
					return;
					break;
			}
			$where = $db->quoteInto($table_name.'_account=?',$account);
			$check_res =$checkobj->fetchRow($where);
			return $check_res;
		}
		//修改密码
		public function modify_password($table_name,$data){
			switch ($table_name) {
				case 'student':
					$modifyobj = new StudentModel();
					$db = $modifyobj->getAdapter();
					break;
				case 'teacher':
					$modifyobj = new TeacherModel();
					$db = $modifyobj->getAdapter();
					break;
				default:
					return;
					break;
			}
			$where = $db->quoteInto($table_name.'_account=?',$data['account']);
			$set = array(
				$table_name.'_password'=>md5($data['newpassword']),
				);
			$modify_res = $modifyobj->update($set,$where);
			return $modify_res;
		}
		
		//过滤输入
		public function filter($oldData){
			if(!is_array($oldData)){
				return $oldData;
			}
			foreach ($oldData as $key => $data) {
				if(is_array($data)){
					foreach ($data as $mykey => $value) {
						$child_data[$mykey] = str_replace(" ", "",htmlspecialchars($value));
					}
					$newData[$key] = $child_data;
				}else{
					$newData[$key] = str_replace(" ", "",htmlspecialchars($data));
				}
			}
			return $newData;
		}

		//查找信息
		//查找全部信息
		public function findall($table_name,$account){
			switch ($table_name) {
				case 'student':
					$findallobj = new StudentModel();
					$db = $findallobj->getAdapter();
					break;
				case 'teacher':
					$findallobj = new TeacherModel();
					$db = $findallobj->getAdapter();
					break;
				case 'admin':
					$findallobj = new AdminModel();
					$db = $findallobj->getAdapter();
					break;	
				default:
					return;
					break;
			}
			$where = $db->quoteInto($table_name.'_account=?',$account);
			$findallobj_res =$findallobj->fetchRow($where);
			return $findallobj_res;
		}
	}