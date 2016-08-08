<?php
	class AdminController extends Zend_Controller_Action  {
		public function init(){
			$this->is_login('admin');
		}
		
		public function adminAction(){}
		
		public function leftAction(){}
			
		public function rightAction(){
			$this->_forward('information','Admininfo');
		}		

	}
