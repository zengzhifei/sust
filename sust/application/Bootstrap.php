<?php
	class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
		function __construct($app){
			parent::__construct($app);
				//开启session
				session_start();	
				//初始化数据库适配器
				$url = constant ("APPLICATION_PATH") . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR . 'application.ini';               
				$dbconfig = new Zend_Config_Ini($url,"mysql");
				$db = Zend_Db::factory($dbconfig->db);
				$db->query('SET NAMES UTF8');
				Zend_Db_Table::setDefaultAdapter($db);
		}
	}