<?php
	class web{
			//系统统计
		public function count(){
			$date        = time();//时间
			$ip          = $_SERVER['REMOTE_ADDR'];//ip
			$old_page    = $_SERVER['HTTP_REFERER'];//来源页面
			$server_name = $_SERVER['SERVER_NAME'];//服务器名
			$remote_host = $_SERVER['REMOTE_HOST'];//主机名
			$data = array("webCount_date"=>$date,
						  "webCount_ip"=>$ip,
						  "webCount_page"=>$old_page,
						  "webCount_hostname"=>$server_name,
						  "webCount_host"=>$remote_host
						);
			$webCountModel = new WebcountModel();
			$count_res = $webCountModel->insert($data);
			return $count_res;
		}
		//系统信息
		public function getinfo(){
			$webCountModel = new WebcountModel();
			$get_res= $webCountModel->fetchAll()->toArray();
			return $get_res;
		}

		//根据时间查询
		public function getCount($date){
			$webCountModel = new WebcountModel();
			$db = $webCountModel->getAdapter();
			$order = "webCount_id";
			$where = $db->quoteInto("webCount_date>=?",$date['start_time']).
					 $db->quoteInto(" AND webCount_date<=?",$date['end_time']);
			$getCount_res = $webCountModel->fetchAll($where,$order);
			return $getCount_res;
		}




	}

