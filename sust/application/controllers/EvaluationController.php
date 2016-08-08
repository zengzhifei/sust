<?php	
	class EvaluationController extends Zend_Controller_Action  {
		public function init(){
			$this->is_login('teacher');
		}
		
		//查看评价
		public function evaluationAction(){
			$account = $_SESSION['account'];
			$evaluation = new evaluation();
			$student = new student();
			$get_res = $evaluation->get_my_evaluation($account);
			if(!empty($get_res)){
				foreach ($get_res as $key => $evaluate) {
					$student_info = $student->find_key($evaluate['evaluation_sid']);
					$get_res[$key]['evaluation_name'] = $student_info['student_name'];
					$get_res[$key]['evaluation_time'] =date("Y-m-d H:i:s",$evaluate['evaluation_time']);
				}
			}			
			//分配结果
			$this->view->evaluations = $get_res;
		}
		
		
	}
