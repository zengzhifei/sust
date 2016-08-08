<?php
	class EvaluateController extends Zend_Controller_Action {
		public function init(){
			$this->is_login('student');
			$this->evaluation = new evaluation();
		}
		//查找所有老师
		public function evaluateAction(){
			//查看是否已评价过
			$account = $_SESSION['account'];
			$get_res = $this->evaluation->get_evaluated($account);
			$teacher = new teacher();
			$teachers = $teacher->get_teachers();
			if(!empty($get_res)){
				foreach ($get_res as $key => $teacher) {
					$all_teachers[] = $teacher['evaluation_tid'];
				}
			}
			if(!empty($all_teachers)){
				foreach ($teachers as $key => $teacher) {
					if(in_array($teacher['teacher_account'], $all_teachers)){
						unset($teachers[$key]);
					}
				}
			}
			//分配名字
			$this->view->teachers = $teachers;
		}
		
		//提交评价
		public function doevaluateAction(){
		    $account = $_SESSION['account'];
		    $oldData = $_POST;
		    $common = new common();
		    $data = $common->filter($oldData);
		    if(empty($data)){
		    	echo false;
		    	exit;
		    }
		    $evaluations = $data['evalation'];
		    $marks       = $data['mark'];
		    foreach ($evaluations as $key => $value) {
		    	if(!$value){
		    		break;
		    	}
		    	$mymark = $marks[$key]?$marks[$key]:5;
		    	$evaluate_data = array(
		    		'tid' => $key,
		    		'sid' => $account,
		    		'evaluation' => $value,
		    		'mark'=> $mymark,
		    		);
		    	$evaluate_res = $this->evaluation->do_evaluation($evaluate_data);
		    	if($evaluate_res){
		    			$evaluation_res[] = true;
		    	}else{
		    			$evaluation_res[] = false;
		    	}
		    }
			foreach ($evaluation_res as $key => $value) {
				if(!$value){
					echo false;
					exit;
				}
			}
			echo true;
			exit;
		}
		
	
	}
