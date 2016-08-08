<?php
	class installController extends Zend_Controller_Action {
		public function init(){
			//禁止渲染视图
			//$this->_helper->viewRenderer->setNoRender();
			 $this->config = new config();
			 $this->tips = array();
		}

		//准备安装工作
		public function installAction(){
			if (!file_exists(APPLICATION_PATH."/configs/installed.txt")) {
				$this->render('install');
				return;
			}
			$tip = "您的电脑已经安装了此软件!";
			$this->view->tip = $tip;
			$this->render('installed');
		}

		//配置
		public function configAction(){
			//接收数据
			$oldData = $_POST;
			//过滤数据
			$common = new common();
			$data = $common->filter($oldData);
			//调用方法配置
			$this->createdatabaseAction($data['database']);			
			$this->createtablestudentAction();
			$this->createtableteacherAction();
			$this->createtableadminAction();
			$this->createtablecourseAction();
			$this->createtableselectcourseAction();
			$this->createtableevaluationAction();
			$this->createtablefilesAction();
			$this->createtablecoursetimeAction();
			$this->createtablewebcountAction();
			$this->createtablepublishAction();
			$this->insertadminAction($data['admin'],md5($data['password']));
			$this->checkconfigsAction();
			//分配页面
			$this->view->tips = $this->tips;
		}

		//数据库创建
		public function createdatabaseAction($database){
			$create_database_res = $this->config -> create_database($database); 
			if ($create_database_res == 404) {
				$db_tip = "数据库创建失败!";
			}else{
				$db_tip = "数据库创建成功!";
			}
				$this->tips[] = $db_tip;

		}

		//学生表创建
		public function createtablestudentAction(){
			
			$create_table_student_res = $this->config -> create_table_student();
			if ($create_table_student_res == 404) {
				$student_tip = "学生表创建失败!";
			}else{
				$student_tip = "学生表创建成功!";
			}
			$this->tips[] = $student_tip;
		}

		//教师表创建
		public function createtableteacherAction(){
			
			$create_table_teacher_res = $this->config -> create_table_teacher();
			if ($create_table_teacher_res == 404) {
				$teacher_tip = "教师表创建失败!";
			}else{
				$teacher_tip = "教师表创建成功!";
			}
			$this->tips[] = $teacher_tip;
		}

		//管理员表创建
		public function createtableadminAction(){
			$create_table_admin_res = $this->config -> create_table_admin();
			if ($create_table_admin_res == 404) {
				$admin_tip = "管理员表创建失败!";
			}else{
				$admin_tip = "管理员表创建成功!";
			}
			$this->tips[] = $admin_tip;
		}
		
		//课程表创建
		public function createtablecourseAction(){
			$create_table_course_res = $this->config -> create_table_course();
			if ($create_table_course_res == 404) {
				$course_tip = "课程表创建失败!";
			}else{
				$course_tip = "课程表创建成功!";
			}
			$this->tips[] = $course_tip;
		}


		//学生选课表创建
		public function createtableselectcourseAction(){
			$create_table_selectCourse_res = $this->config -> create_table_selectCourse();
			if ($create_table_selectCourse_res == 404) {
				$selectCourse_tip = "选课表创建失败!";
			}else{
				$selectCourse_tip = "选课表创建成功!";
			}
			$this->tips[] = $selectCourse_tip;
		}
			
		//学生评价表创建
		public function createtableevaluationAction(){
			$create_table_evaluation_res = $this->config -> create_table_evaluation();
			if ($create_table_evaluation_res == 404) {
				$evaluation_tip = "评价表创建失败!";
			}else{
				$evaluation_tip = "评价表创建成功!";
			}
			$this->tips[] = $evaluation_tip;
		}

		//文件表创建
		public function createtablefilesAction(){
			$create_table_files_res = $this->config -> create_table_files();
			if ($create_table_files_res == 404) {
				$files_tip = "文件表创建失败!";
			}else{
				$files_tip = "文件表创建成功!";
			}
			$this->tips[] = $files_tip;
		}
	
		//课程表创建
		public function createtablecoursetimeAction(){
			$create_table_courseTime_res = $this->config -> create_table_courseTime();
			if ($create_table_courseTime_res == 404) {
				$courseTime_tip = "课程时间表创建失败!";
			}else{
				$courseTime_tip = "课程时间表创建成功!";
			}
			$this->tips[] = $courseTime_tip;
		}

		//创建网站管理表
		public function createtablewebcountAction(){
			$create_table_webCount_res = $this->config -> create_table_webCount();
			if ($create_table_webCount_res == 404) {
				$webCount_tip = "系统管理表创建失败!";
			}else{
				$webCount_tip = "系统管理表创建成功!";
			}
			$this->tips[] = $webCount_tip;
		}

		//创建通知表
		public function createtablepublishAction(){
			$create_table_publish_res = $this->config -> create_table_publish();
			if($create_table_publish_res == 404){
				$publish_tip = "系统通知表创建失败!";
			}else{
				$publish_tip = "系统通知表创建成功!";
			}
			$this->tips[] = $publish_tip;
		}
		//添加管理员
		public function insertadminAction($admin,$pas){
			$insert_admin_res = $this->config -> insert_admin($admin,$pas);
			if ($insert_admin_res == 404) {
				$insert_admin_tip = "管理员添加失败!";
			}else{
				$insert_admin_tip = "管理员添加成功!";
			}
			$this->tips[] = $insert_admin_tip;
		}

		//检验配置结果
		public function checkconfigsAction(){
			$check_configs_res = $this->config -> check_configs();
			if ($check_configs_res == 404) {
				$check_configs_tip = "配置失败!";
			}else{
					$check_configs_tip = "配置成功!";
				}
			$this->tips[] = $check_configs_tip;

		}


	}

