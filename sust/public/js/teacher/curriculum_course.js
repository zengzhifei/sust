/**
 *@author:zengzf
 *2016.03.22
 **/
 $(function(){
 	//修改课程信息
 	$(document).on('dblclick','.change',function(){
 		var courseid = $(this).attr('coursename');
 		var oldValue    = $(this).text();
 		$(this).replaceWith("<td class='newElement'><input type='text' id='newElement' value="+oldValue+"></td>");
 		$("#newElement").blur(function(){
	 		Dialog.confirm('警告：您确定修改吗？',function(){
	 			var newValue = $("#newElement").val();
	 			$.ajax({
	 				url:'/Courseinfo/modifytime',
	 				type:'POST',
	 				data:{'courseTime_id':courseid,'courseTime_courseName':newValue},
					success:function(msg){
							if(!msg){
								box('error','无任何修改');
							}else{
								box('ok',"修改成功");
								$(".newElement").replaceWith("<td class='change' coursename="+courseid+">"+newValue+"</td>");
							}
						},
					error:function(){
							box('error','网络错误');
					}
	 			})
	 		},function(){
	 			$(".newElement").replaceWith("<td class='change' coursename="+courseid+">"+oldValue+"</td>");
	 		})
	 	})
 	});


 })