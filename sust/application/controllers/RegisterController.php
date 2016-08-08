<?php
	class RegisterController extends Zend_Controller_Action {
		//去到注册页面
		public function registerAction(){}
		
		//检验账号是否已注册
		public function checkaccountAction(){
			$oldDate = $_POST;
			$common = new common();
			$data = $common->filter($oldDate);
			$check_res = $common->check_exist('student',$data['account']);
			if($check_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}	
		//注册		
		public function goregisterAction(){
			$oldDate = $_POST;
			$common = new common();
			//过滤数据
			$data = $common->filter($oldDate);
			$register = new myregister();
			$register_res = $register->register($data);
			if($register_res){
				session_start();
				$_SESSION['account'] = $data['account'];
				$_SESSION['system']  = 'student';
				echo "/Student/student";
			}else{
				echo false;
			}
			exit;
		}
		//验证验证码
		public function checkcodeAction(){
			$common = new common();
			$oldData = $_POST;
			$data = $common->filter($oldData);
			if($data && (strtolower($data['code'])==$_SESSION['code'])){
				echo true;
			}else{
				echo false;
			}
			exit;
		}
		
		
	}
