<?php
	class InformationController extends Zend_Controller_Action{
		public function init(){
			$this->is_login('student');
			$this->information = new information();
		}

		public function infoAction(){
			$account = $_SESSION['account'];
			$info = $this->information->get_info($account);
			$name = $info['student_name'];
			$this->view->name = $name;
			$this->view->account = $account;
		}

		public function completeAction(){
			//接收信息
			$oldData = $_POST;
			$common = new common();
			$data = $common->filter($oldData);
			$information = new information();
			$complete_res = $this->information->complete($data);
			if($complete_res){
				echo true;
			}else{
				echo false;
			}
			exit;
		}
		
		public function informationAction(){
			//查找个人信息
			$account=$_SESSION['account'];
			$info = $this->information->get_info($account);
			
			$date=substr($account,0,4)."年";		//入学年份
			$college=substr($account,4,2);		//学院
			switch ($college){
				case "01":
					$mycollege="轻工与能源学院";
					break;
				case "02":
					$mycollege="材料科学与工程学院";
					break;
				case "03":
					$mycollege="资源与环境学院";
					break;
				case "04":
					$mycollege="生命科学与工程学院";
					break;
				case "05":
					$mycollege="管理学院";
					break;
				case "06":
					$mycollege="电气与信息工程学院";
					break;
				case "07":
					$mycollege="机电工程学院";
					break;
				case "08":
					$mycollege="理学院";
					break;
				case "09":
					$mycollege="设计与艺术学院";
					break;
				case "10":
					$mycollege="文化传播学院";
					break;	
				case "11":
					$mycollege="化学与化工学院";
					break;	
				default:
					$mycollege="无";
					break;
					
			}
			
			$professional=substr($account,6,2);		//专业
			$class=substr($account,8,2);			//班级
			switch ($class){
				case "01":
					$myclass="1班";
					break;
				case "02":
					$myclass="2班";
					break;	
				case "03":
					$myclass="3班";
					break;	
				case "04":
					$myclass="4班";
					break;
				case "05":
					$myclass="5班";
					break;
				case "06":
					$myclass="6班";
					break;	
				default:
					$myclass="无";
					break;					
			}
			
			$personID = $info['student_personID'];					//身份证号
			$brithYear = substr($personID,6,4);				//出生年
			$brithMonth = substr($personID,10,2);				//出生月
			$brithDay=substr($personID,12,2);				//出生日
			$brith=$brithYear.".".$brithMonth.".".$brithDay;		

			//分配信息
			$this->view->account=$account;//学号.
			$this->view->sex=$info['student_sex'];//性别.
			$this->view->address=$info['student_address'];//籍贯.
			$this->view->nation=$info['student_nation'];//民族.
			$this->view->member=$info['student_member'];//政治面貌.
			$this->view->hostel=$info['student_hostel'];//宿舍.
			$this->view->date=$date;//入学时间
			$this->view->mycollege=$mycollege;//学院.
			$this->view->myclass=$myclass;//班级.
			$this->view->professional=$professional;//专业.
			$this->view->personID=$personID;//身份证
			$this->view->brith=$brith;//生日.
			$this->view->name=$info['student_name'];//名字.
			$this->view->note=$info['student_note'];

		}
		
	}

