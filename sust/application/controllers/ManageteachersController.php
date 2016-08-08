<?php
	class ManageteachersController extends Zend_Controller_Action {
		public function init(){
			$this->is_login("admin");
			$this->admin = new admin();
		}
		//教师管理界面
		public function teacherslistAction(){
			$teacher = new teacher();
			$teachers =  $teacher->get_teachers();
			$this->view->teachers=$teachers;	
		}
		//添加教师界面
		public function addteacheruiAction(){}

		//判断工号是否存在
		public function checkaccountAction(){
			$oldDate = $_POST;
			$common = new common();
			$data = $common->filter($oldDate);
			$check_res = $common->check_exist('teacher',$data['account']);
			if($check_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}	
		
		//删除教师
		public function deleteteacherAction(){		
			$account = $this->getRequest()->getParam('account');
			$delete_res = $this->admin->delete("teacher",$account);		
			if ($delete_res){
				echo 200;
			}else{
				echo 500;			
			}	
			exit;
		}
		
		//查找教师
		public function findteacherAction(){
			//接收数据
			$oldData = $_POST;
			//过滤数据
			$common = new common();
			$data = $common->filter($oldData);
			$teachers = $this->admin->find("teacher",$data['key_word']);
			$arr = array();
$table = <<<EOF
			<table>
				<tr class="tabletitle">
					<td>ID</td><td>姓名</td><td>账号</td><td>密码</td><td>电话</td><td>Email</td><td>初始化</td><td>操作</td>
				</tr>
EOF;
			$arr[] = $table;
			foreach ($teachers as $key=>$teacher){
			$table = <<<EOF
				<tr class="lists">
					<td class="tdID">{$teacher['teacher_id']}</td>
					<td class="change" name="teacher_name" account={$teacher['teacher_account']}>{$teacher['teacher_name']}</td>
					<td>{$teacher['teacher_account']}</td>
					<td class="change" name="teacher_password" account={$teacher['teacher_account']}>{$teacher['teacher_password']}</td>
					<td class="change" name="teacher_phone" account={$teacher['teacher_account']}>{$teacher['teacher_phone']}</td>
					<td class="change" name="teacher_email" account={$teacher['teacher_account']}>{$teacher['teacher_email']}</td>
					<td class="change" name="teacher_key" account="{$teacher['teacher_account']}">{$teacher['teacher_key']}</td>
					<td><a title="删除该信息" href="javascript:void(0)" account={$teacher['teacher_account']} class="delete">删除</a>&nbsp;|&nbsp;
						<a title="修改该信息" href="javascript:void(0)" class="alter">修改</a></td>
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
		
		//添加教师
		public function addteacherAction(){
			$oldDate = $_POST;
			$common = new common();
			$data = $common->filter($oldDate);
			$add_res = $this->admin->add("teacher",$data);			
			if($add_res>0){
				echo '/Manageteachers/teacherslist';
			}else{
				echo false;
			}
				exit;
		}

		//修改资料
		public function updateteacherAction(){
			//禁止渲染视图
			$this->_helper->viewRenderer->setNoRender();

			$oldDate = $_POST;
			$common = new common();
			$data = $common->filter($oldDate);
			if($data['name'] == "teacher_password" && $data['value'] == ""){
				echo 500;
			}else{
				if ($data['name'] == "teacher_password") {
					$data['value'] = md5($data['value']);
				}
				$update_res = $this->admin->update("teacher",$data);
				if ($update_res) {
					echo $data['value'];
				}else{
					echo false;
				}
			}
		}
		
		
	}

