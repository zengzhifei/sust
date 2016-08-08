<?php
	class ManagestudentsController extends Zend_Controller_Action {
		//初始化函数，判断权限
		public function init(){
			$this->is_login("admin");
			$this->admin = new admin();
		}
		
		//学生管理界面
		public function studentslistAction(){		
			$student = new student();
			$students = $student->find_all();
			$this->view->students = $students;	
		}
		
		//删除学生
		public function deletestudentAction(){			
			$account = $this->getRequest()->getParam('account');
			$delete_res = $this->admin->delete("student",$account);		
			if ($delete_res){
				echo 200;
			}else{
				echo 500;			
			}	
			exit;		
		}
		
		//查找学生
		public function findstudentAction(){		
			//接收数据
			$oldData = $_POST;
			//过滤数据
			$common = new common();
			$data = $common->filter($oldData);
			$students = $this->admin->find("student",$data['key_word']);
			$arr = array();
$table = <<<EOF
			<table>
				<tr class="tabletitle">
					<td>ID</td><td>姓名</td><td>账号</td><td>密码</td><td>身份证号</td><td>性别</td><td>地址</td><td>民族</td><td>身份</td><td>宿舍号</td><td>备注</td><td>初始化</td><td>操作</td>
				</tr>
EOF;
			$arr[] = $table;
			foreach ($students as $key=>$student){
			$table = <<<EOF
				<tr class="lists">
					<td class="tdID">{$student['student_id']}</td><td>{$student['student_name']}</td>
					<td>{$student['student_account']}</td><td>{$student['student_password']}</td>
					<td>{$student['student_personID']}</td><td>{$student['student_sex']}</td>
					<td>{$student['student_address']}</td><td>{$student['student_nation']}</td>
					<td>{$student['student_member']}</td><td>{$student['student_hostel']}</td>
					<td>{$student['student_note']}</td><td>{$student['student_key']}</td>
					<td><a title="删除" href="javascript:void(0)" class="delete" account="{$student['student_account']}">删除</a></td>
				</tr>
EOF;
			$arr[] = $table;
			}
			$table ='</table>';
			$arr[] = $table;
			$tablelist = join('', $arr);
			echo $tablelist;
			exit;
		}
	}