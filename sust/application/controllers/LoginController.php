<?php
		class LoginController extends Zend_Controller_Action{
			//初始化函数
			public  function init(){
				$this->login = new login();
			}
			
			//去login界面
			public function loginAction(){}

			//检查是否存在该账号
			public function checkinAction(){
				//禁止渲染视图
				$this->_helper->viewRenderer->setNoRender();
				//获取ajax请求参数
				$radio = $this->getRequest()->getParam('radio');
				$account = $this->getRequest()->getParam('account');
				$result = $this->login->check_in($radio,$account);
				if($result == NULL){
					echo 404;
				}else{
					echo 200;
				}
				
			}
			
			//验证账号
			public function checkAction(){
				if(isset($_SESSION['account'])){
					echo 500;
					exit;
				}
				//接收数据
				$oldData = $_POST;
				//过滤数据
				$common = new common();
				$data = $common->filter($oldData);
				$check_result = $this->login->check($data["radio"],$data["account"],$data["password"]);
				if($check_result){
					$_SESSION['account'] = $data['account'];
					$_SESSION['system']  = $data["radio"];
					echo "/{$data['radio']}/{$data['radio']}";
				}else{
					echo false;
				}
				exit;
			}
			
			//忘记密码界面
			public function findpasswordAction(){}
			
			//检验身份证号
			public function checkpersonidAction(){
				$oldData = $_POST;
				$common  = new common();
				$data = $common->filter($oldData);
				$check_res = $this->login->check_personid($data);
				if($check_res){
					echo true;
				}else{
					echo false;
				}
				exit;
			}

			//找回密码
			public function findpswAction(){
				$oldData = $_POST;
				$common  = new common();
				$data = $common->filter($oldData);
				if(!$data['newpassword']){
					echo false;
					exit;
				}
				$find_res = $common->modify_password('student',$data);
				if($find_res){
					echo true;
				}else{
					echo false;
				}
				exit;
			}

			//退出登录账号
			public function loginoutAction(){
				$_SESSION = array();
				if(session_destroy()){
					echo true;
				}else{
					echo false;
				}
				exit;
			}

		}
