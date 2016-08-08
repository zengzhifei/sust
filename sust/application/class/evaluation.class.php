<?php
	class evaluation{
		//取出学生评论
		public function get_evaluated($account){
			$evaluationModel = new EvaluationModel();
			$db = $evaluationModel->getAdapter();
			$where = $db->quoteInto("evaluation_sid=?",$account);
			$get_res = $evaluationModel->fetchAll($where)->toArray();
			return $get_res; 
		}
		//提交评论
		public function do_evaluation($data){
			$evaluationModel = new EvaluationModel();
			$data = array(
				'evaluation_sid' => $data['sid'],
				'evaluation_tid' => $data['tid'],
				'evaluation_evaluate' =>$data['evaluation'],
				'evaluation_mark'=> $data['mark'],
				'evaluation_time'=> time(),
				);
			$evaluate_res = $evaluationModel->insert($data);
			return $evaluate_res;
		}
		//查看学生评论
		public function get_my_evaluation($account){
			$evaluationModel = new EvaluationModel();
			$db = $evaluationModel->getAdapter();
			$where = $db->quoteInto("evaluation_tid=?",$account);
			$get_res = $evaluationModel->fetchAll($where)->toArray();
			return $get_res; 
		}





	}
