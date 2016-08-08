<?php
	class ManagewebController extends Zend_Controller_Action {
		public function init(){
			$this->is_login('admin');
			$this->web = new Web();
		}
		//取出所有信息
		public function getinfoAction(){
			$sys_info = $this->web->getinfo();
			$this->view->webCount = $sys_info;
			$this->render('ip');
		}
		//取出IP记录
		public function getcountAction(){	
			$start = $this->getRequest()->getParam('start_time');
			$end   = $this->getRequest()->getParam('end_time');
			$start_time = empty($start)?"2000-01-01":$start;
			$end_time   = empty($end)?date("Y-m-d H:i:s"):$end;
			$date = array(
					"start_time"=>strtotime($start_time),
					"end_time"=>strtotime($end_time)
				);		
			$getCount_res = $this->web->getCount($date);

			$arr = array();
			$table = <<<EOF
			<table>
				<tr class="tabletitle">
					<td>ID</td><td>浏览时间</td><td>IP</td><td>来源地址</td><td>服务器名</td><td>主机名</td>
				</tr>
EOF;
			$arr[] = $table;
			foreach ($getCount_res as $key=>$count){
				$timecount = date("Y-m-d H:i:s",$count['webCount_date']);		
				$table = <<<EOF
				<tr class="lists">
						<td class="tdID">{$count['webCount_id']}</td>
						<td>$timecount</td>
						<td>{$count['webCount_ip']}</td>
						<td>{$count['webCount_page']}</td>
						<td>{$count['webCount_hostname']}</td>
						<td>{$count['webCount_host']}</td>
					</tr>
EOF;
				$arr[] = $table;
			}
			$table = '</table>';
			$arr[] = $table;

			$tablelists = join('',$arr);
			echo $tablelists;
			exit;
		}
	}
