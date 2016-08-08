<?php
	class CodeController extends Zend_Controller_Action{
		public function codeAction(){
			 //构造方法
			 $vcode = new Vcode(135, 40, 4);
			 //将验证码放到服务器自己的空间保存一份
			 $_SESSION['code'] = strtolower($vcode->getcode());
			 //将验证码图片输出
			 $vcode->outimg();
			 exit;
		}


	}
