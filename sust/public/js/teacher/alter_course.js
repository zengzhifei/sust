/**
 *@author:zengzf
 *2016.03.22
 */
 $(function(){
 	//删除课程
 	$(document).on('click','.deletecourse',function(){
 		var element = $(this);
 		Dialog.confirm('警告：您确认删除该条课程？',function(){
 			$.ajax({
 				url:'/Createcourse/deletecourse',
 				type:'POST',
 				data:{'course_id':element.attr("courseid")},
 				success:function(msg){
 					if(msg){
 						setTimeout("window.location.reload()",2000);
 						box('ok','删除成功');
 					}else{
 						box('error','删除失败');
 					}
 				},
 				error:function(){
 					box('error','网络错误');
 				}
 			})
 		})
 	})


 })