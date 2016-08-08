<?php
		 class MarkController extends Zend_Controller_Action {
				public function init(){
					$this->is_login('teacher');
					$this->course = new course();
				}
				
				public function markAction(){
					$courses = $this->course -> get_course();
					$this->view->courses = $courses;
				}
				
				//拿到课程人
				public function personinfoAction(){
					$courseid = $this->getRequest()->getParam('course_id');
					$_SESSION['courseid'] = $courseid;
					$course_info = $this->course->get_number($courseid);
					$student = new student();
					foreach ($course_info as $key => $value) {
						$student_info[] = $student->find_key($value['selectCourse_sid'])->toArray();
					}
					$arr = array();
					if(count($student_info)){
						$table = <<<EOF
						<form>		
							<table>
								<tr id="tabletitle">
									<td>学号</td><td>选课人</td><td>分数</td>
								<tr>
EOF;
						$arr[] = $table;
						foreach ($student_info as $key=>$student) {
						$table = <<<EOF
								<tr class="lists">
									<td>{$student['student_account']}</td>
									<td>{$student['student_name']}</td>
									<td><input type='text' name="{$student['student_account']}"></td>
								</tr>
EOF;
						$arr[] = $table;
						}	
						$table = <<<EOF
							</table>
						</form>
						<div id='btn'>
							<button type="button" id="sub">提交</button>
						</div>
EOF;
						$arr[] = $table;
					}else{
						$table = "<div id='note'>暂无人选该课程</div>";
						$arr[] = $table;
					}
					$tablelists = join('',$arr);
					echo $tablelists;
					exit; 
				}
				
				//提交成绩
				public function domarkAction(){
					$oldData = $_POST;
					$common = new common();
					$data = $common->filter($oldData);
					$courseid = $_SESSION['courseid'];
					$course_info = $this->course->get_course_info($courseid);
					$credit = $course_info['course_credit'];
					$mark = new mark();
					foreach ($data as $key => $value) {
						$newcredit = ($value>=60) ? $credit : 0;
						$newdata = array('sid'=>$key,'cid'=>$courseid,'grade'=>$value,'credit'=>$newcredit);
						$res = $mark->do_mark($newdata);
						if(!$res){
							$mark_res[] = false;
						}else{
							$mark_res[] = true;
						}
					}						
					foreach ($mark_res as $key => $value) {
						if (!$value) {
							echo false;
							exit;
						}
					}
					echo true;
					exit;
				}
		
	}