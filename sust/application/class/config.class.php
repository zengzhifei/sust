<?php
			class config{
				private $conn;
				private $host;
				private $username;
				private $password;
				private $db;
				private $key 	  = array("create_db"=>flase,"select_db"=>false,"create_table_student"=>false,
										 "create_table_teacher"=>false,"create_table_admin"=>false,
										 "create_table_course"=>false,"create_table_selectCourse"=>false,
										 "create_table_evaluation"=>false,"create_table_files"=>false,
										 "create_table_courseTime"=>false,"create_table_webCount"=>false,
										 "create_table_publish"=>false,"insert_admin"=>false);

				//连接并创建数据库;
				public function __construct(){
					$ini_config = new Zend_Config_Ini(APPLICATION_PATH."/configs/application.ini",'mysql');
					$this->host     = $ini_config->db->params->host;
					$this->username = $ini_config->db->params->username;
					$this->password = $ini_config->db->params->password;
					//连接数据库
					$this->conn = mysql_connect($this->host,$this->username,$this->password);
					//设置编码语言
					mysql_query("SET NAMES UTF8",$this->conn);
				}

				//创建数据库
				public function create_database($database){
					//获取数据库名
					$this->db = $database;
					//创建数据库
					if(mysql_query("create database $this->db")){
						$this->key['create_db'] = true;
						$this->select_database();
						return $this->db;
					}

						return 404;
				}
					//选择数据库
				public function select_database(){
						if(mysql_select_db($this->db,$this->conn)){
							$this->key['select_db'] = true;
							return;
						}
				}

				//创建学生表
				public function create_table_student(){

					if ($this->key['select_db']) {
						
						$sql = "create table ".$this->db."_student(
								student_id int unsigned primary key auto_increment,  
								student_account varchar(128)  not null,
								student_password varchar(64) not null,
								student_name varchar(32) not null,
								student_personID varchar(128),
								student_sex varchar(2) default '男',
								student_address varchar(64),
								student_nation varchar(16),
								student_member varchar(8) default '其他',
								student_hostel varchar(16),
								student_note text,
								student_key tinyint(2) default 0							
						)";

						if(mysql_query($sql,$this->conn)){
							$this->key['create_table_student'] = true;
							return $this->db."_student";
						}
					}

					return 404;
				}

				//创建教师表
				public function create_table_teacher(){

					if ($this->key['select_db']) {
						
						$sql = "create table ".$this->db."_teacher(
								teacher_id int unsigned primary key auto_increment,							
								teacher_account varchar(128) not null,
								teacher_password varchar(64) not null,
								teacher_name varchar(32) not null,
								teacher_phone varchar(64),
								teacher_email varchar(128),
								teacher_key tinyint(2) default 0							
						)";

						if(mysql_query($sql,$this->conn)){
							$this->key['create_table_teacher'] = true;
							return $this->db."_teacher";
						}
					}

					return 404;
				}
					//创建管理员表
				public function create_table_admin(){

						if ($this->key['select_db']) {
							
							$sql = "create table ".$this->db."_admin(
									admin_id int unsigned primary key auto_increment,		
									admin_account varchar(64) not null,
									admin_password varchar(32) not null,
									admin_name varchar(50),
									admin_phone varchar(64),
									admin_email varchar(128),
									admin_key tinyint(2) default 0				
							)";

							if(mysql_query($sql,$this->conn)){
								$this->key['create_table_admin'] = true;
								return $this->db."_admin";
							}
						}

						return 404;
				}

				//添加课程表
				public function create_table_course(){
					if ($this->key['select_db']) {
						$sql = "create table ".$this->db."_course(
							course_id int unsigned primary key auto_increment,
							course_name varchar(32) not null,
							course_credit int(4) not null default 0,
							course_term int(12) not null				
							)";
					
						if(mysql_query($sql,$this->conn)){
							$this->key['create_table_course'] = true;
								return $this->db."_course";
						}
					}
					
					return 404;
				}

					//创建学生选课表
				public function create_table_selectCourse(){

						if ($this->key['select_db']) {
							
							$sql = "create table ".$this->db."_selectCourse(
									selectCourse_id int unsigned primary key auto_increment,
									selectCourse_sid varchar(128) not null,
								    selectCourse_cid varchar(64) not null,
								    selectCourse_grade varchar(8),
									selectCourse_credit tinyint(2) not null default 0,
									foreign key (selectCourse_sid) references ".$this->db."_student(student_account),
									foreign key (selectCourse_cid) references ".$this->db."_course(id)							
							)";

							if(mysql_query($sql,$this->conn)){
								$this->key['create_table_selectCourse'] = true;
								return $this->db."_selectCourse";
							}
						}

						return 404;
				}

					//创建学生评价表
				public function create_table_evaluation(){

						if ($this->key['select_db']) {
							
							$sql = "create table ".$this->db."_evaluation(
									evaluation_id int unsigned primary key auto_increment,
									evaluation_tid varchar(64) not null,
									evaluation_sid varchar(64) not null,
									evaluation_evaluate varchar(120) not null,
									evaluation_mark tinyint(4) not null default 0,
									evaluation_time int(11) not null default 0							
							)";

							if(mysql_query($sql,$this->conn)){
								$this->key['create_table_evaluation'] = true;
								return $this->db."_evaluation";
							}
						}

						return 404;
					}

					//创建文件表
				public function create_table_files(){

						if ($this->key['select_db']) {
							
							$sql = "create table ".$this->db."_files(
									files_id int unsigned primary key auto_increment,
									files_fileName varchar(128) not null,
									files_authorName varchar(64) not null,
									files_intro varchar(128) not null,
									files_path varchar(2000) not null,
									files_time int(11) not null							
							)";

							if(mysql_query($sql,$this->conn)){
								$this->key['create_table_files'] = true;
								return $this->db."_files";
							}
						}
					return 404;
				}

				//创建课程表
				public function create_table_courseTime(){

							if ($this->key['select_db']) {
								
								$sql = "create table ".$this->db."_courseTime(
										courseTime_id int unsigned primary key auto_increment,
										courseTime_ctime varchar(4),
										courseTime_courseName varchar(64),
										courseTime_term varchar(32)							
								)";

								if(mysql_query($sql,$this->conn)){
									$this->key['create_table_courseTime'] = true;
									return $this->db."_courseTime";

								}
						}

						return 404;
				}

				//创建网站管理表
				public function create_table_webCount(){
					if ($this->key['select_db']) {
							
						$sql = "create table ".$this->db."_webCount(
								webCount_id int unsigned primary key auto_increment,
								webCount_date int(11),
								webCount_ip varchar(128),
								webCount_page varchar(128),
								webCount_hostname varchar(128),
								webCount_host varchar(128)
							)";
						
						if(mysql_query($sql,$this->conn)){
							$this->key['create_table_webCount'] = true;
							return $this->db."_webCount";
						}

					}
					return 404;
				}

				//创建通知表
				public function create_table_publish(){
					if($this->key['select_db']){
						$sql = "create table ".$this->db."_publish(
								publish_id int unsigned primary key auto_increment,
								publish_title varchar(502) not null,
								publish_content varchar(4096),
								publish_author varchar(64),
								publish_date int(11)
							)";
						if(mysql_query($sql,$this->conn)){
							$this->key['create_table_publish'] = true;
							return $this->db."_publish";
						}
					}
					return 404;
				}	

				//添加管理员
				public function insert_admin($admin,$adminPas){

					if ($this->key['create_table_admin']) {
							$sql = "insert into ".$this->db."_admin values(null,'".$admin."','".$adminPas."',null,null,null,0)";
							if(mysql_query($sql,$this->conn)){
								$this->key['insert_admin'] = true;
								return $admin;
							}
						}
						return 404;
				}

				//检查配置结果
				public function check_configs(){
					$check_result = false;
					foreach ($this->key as $key => $value) { 
						if(!$value) {
							$this->delete_database();
							$this->replace_db_ini();
							$this->delete_installed_file();
							$check_result = false;
							break;	
						}else{
							$check_result = true;
						}
					}
					if($check_result){
						if($this->create_installed_file()){
							if($this->replace_db_ini()){
								return 100;
							}
						}
					}
					return 404;
				}

				//创建表失败的情况下，删除数据库
				public function delete_database(){
					$sql = "drop database ".$this->db;
					if(mysql_query($sql,$this->conn)){
						$this->db = null;
					}
				}

				//修改ini配置文件
				public function replace_db_ini(){
					$ini_config = new Zend_Config_Ini(APPLICATION_PATH."/configs/application.ini",'mysql');
					$ini_dbname = $ini_config->db->params->dbname;
					$old_ini = file_get_contents(APPLICATION_PATH."/configs/application.ini");
					$updata_ini = str_replace("db.params.dbname=".$ini_dbname, "db.params.dbname=".$this->db, $old_ini);
					$new_ini = file_put_contents(APPLICATION_PATH."/configs/application.ini", $updata_ini);
					if ($new_ini) {
						return true;
					}
					return false;
				}

				//创建钥匙文件
				public function create_installed_file(){
					$key_file = fopen(APPLICATION_PATH."/configs/installed.txt", "w");
					if(fclose($key_file)){
						return true;
					}
					return false;
				}

				//删除钥匙文件
				public function delete_installed_file(){
					$key_file = APPLICATION_PATH."/configs/installed.txt";
					if(file_exists($key_file)){
						@unlink($key_file);
					}
				}

				

				//关闭数据库连接
				public function __destruct(){
					//如果程序中断，则退出程序前撤销已执行操作
					if($this->db != null) {
						foreach ($this->key as $key => $value) {
							if(!$value) {
								$this->delete_database();
								break;	
							}
						}	
					}
				mysql_close($this->conn);
				}
		}

