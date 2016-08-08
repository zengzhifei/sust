<?php
	class publish{
		//保存通知
		public function do_publish($data){
			$publishModel = new PublishModel();
			$newdata = array(
				'publish_title'  =>$data['title'],
				'publish_content'=>$data['content'],
				'publish_author' =>$data['author'],
				'publish_date'   =>time()
				);
			$publish_res = $publishModel->insert($newdata);
			return $publish_res;
		}

		//取出通知
		public function get_publish(){
			$publishModel = new PublishModel();
			$db = $publishModel->getAdapter();
			$order = "publish_id";
			$date = date("Y")-1;
			$date = $date."-01-01 00:00:00";
			$date = strtotime($date);
			$where = $db->quoteInto("publish_date>=?",$date);
			$get_res = $publishModel->fetchAll($where,$order)->toArray();
			return $get_res;
		}

		//删除通知
		public function delete_publish($publish_id){
			$publishModel = new PublishModel();
			$db = $publishModel->getAdapter();
			$where = $db->quoteInto("publish_id=?",$publish_id);
			$delete_res = $publishModel->delete($where);
			return $delete_res; 
		}


	}