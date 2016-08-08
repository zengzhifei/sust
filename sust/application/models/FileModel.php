<?php
	class FileModel extends Zend_Db_Table {
		protected $_name;
		protected $_primary='files_id';

		public function _setup(){
			$ini_config = new Zend_Config_Ini(APPLICATION_PATH."/configs/application.ini",'mysql');
			$ini_dbname = $ini_config->db->params->dbname;
			$this->_name = $ini_dbname."_files";
			parent::_setup();
		}
		
	}