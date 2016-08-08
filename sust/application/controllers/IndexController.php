<?php

	class IndexController extends Zend_Controller_Action {
		//主页显示
	    public function indexAction(){
			//顶部显示
	    	$this->navshowAction();
	       //统计浏览人数
	       $web = new web();
		   $count_number = $web->count();
	       $this->view->countID = $count_number;
	    }

	    //顶部显示
	    public function navshowAction(){
	       //time
	       $date=date("Y年m月d日");
	       switch (date("N")) {
	       	case '1':
	       		$date = $date."　星期一";
	       		break;
	       	case '2':
	       		$date = $date."　星期二";
	       		break;
	       	case '3':
	       		$date = $date."　星期三";
	       		break;
	       	case '4':
	       		$date = $date."　星期四";
	       		break;
	       	case '5':
	       		$date = $date."　星期五";
	       		break;
	       	case '6':
	       		$date = $date."　星期六";
	       		break;
	        case '7':
	       		$date = $date."　星期日";
	       		break;
	       	default:
	       		break;
	       }
	       $this->view->time = $date;
	       //name
	       if(!empty($_SESSION['account']) && !empty($_SESSION['system'])){
	       		$common = new common();
	       		$info   = $common->findall($_SESSION['system'],$_SESSION['account']);
	       		$name   = $info[$_SESSION['system'].'_name'];
	       		if($_SESSION['system']=='admin'){
	       			$name = $name?$name:'管理员';
	       		}
	       		$urlstart='<a href="/'.$_SESSION['system']."/".$_SESSION['system'].'"'.'>';
				$urlend='</a>';
	       		$this->view->name = "欢迎回来 [".$urlstart.$name.$urlend."]";
	       }else{
	       		$this->view->name="游客,你好";
	       }
	    }

	    //显示通知
	    public function publishshowAction(){
	    	$publish = new publish();
	    	$publish_info = $publish->get_publish();
	    	if(!empty($publish_info)){
	    		$arr = array();
	    		$content = array();
	    		$arr[] = "<table>";
	    		$temp = 1;
	    		foreach($publish_info as $key => $value){
	    		$publish_date = date("Y-m-d H:i:s",$value['publish_date']);
	    		$table = <<<EOF
	    			<tr class='lists'>
	    				<td class="tdID">[{$temp}]</td>
	    				<td><a href="javascript:void(0)" class="jumppublish" publishid={$value['publish_id']}>{$value['publish_title']}</a></td>
	    				<td>{$value['publish_author']}</td>
	    				<td>{$publish_date}</td>
	    			</tr>
EOF;
				$table_info = <<<EOF
					<div class='publishinfo' publishid={$value['publish_id']}>
						<div class='infotitle'>{$value['publish_title']}</div>
						<div class='infocontent'>{$value['publish_content']}</div>
						<button type='button' class='closeinfo'>X</button>
					</div>
EOF;
				$arr[] = $table;
				$content[] = $table_info;
				++$temp;
				}
				$arr[] = "</table>";
				$info[] = join('',$arr);
				$info[] = join('',$content);
				echo json_encode($info);
				exit;
			}else{
				$info[] = "<table>
								<tr id='note'><td>暂无通知</td></tr>
							</table>";
				echo json_encode($info);
				exit;	
			}
	    }

	}

