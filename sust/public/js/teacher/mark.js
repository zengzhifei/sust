/**
 *@author:zengzf
 *2016.03.23
 */
 $(function(){
 	//显示选课人
 	$(document).on('click','#search',function(){
 		var courseid   = $("#select option:selected").attr('courseid');
 		var coursename = $("#select option:selected").text();
 		if(courseid){
	 		$.ajax({
	 			url:'/Mark/personinfo',
	 			type:'POST',
	 			data:{'course_id':courseid,'course_name':coursename},
	 			success:function(msg){
	 				if(msg){
	 					$("#marklist").html(msg);
	 				}
	 			},
	 			error:function(){
	 				box('error','网络错误');
	 			}
	 		})
 		}else{
 			$("#marklist").html("<div id='note'>请选择科目</div>");
 		}	
 	})
 	//评分
 	$(document).on('click','#sub',function(){
 		$.ajax({
 			url:'/Mark/domark',
 			type:'POST',
 			data:$("form").serialize(),
 			success:function(msg){
 				if(msg){
 					setTimeout("window.location.reload()",2000);
 					box('ok','评分成功');
 				}else{
 					box('error','评分失败');
 				}
 			},
 			error:function(){
 				box('error','网络错误');
 			},
 		})
 	})


 })