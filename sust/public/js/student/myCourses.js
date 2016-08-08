/**
 *@author:zengzf
 *2016.03.27
 **/
 $(function(){
 	//隐藏按钮
 	if($("#note").length>0){
 		$("#btn").hide();
 	}
 	//删除选课
 	$(document).on('click','#sub',function(){
 		Dialog.confirm('警告：您确认删除该选课？',function(){
 			$.ajax({
	 			url:'/selectcourse/delcourse',
	 			type:'POST',
	 			data:$('form').serialize(),
	 			success:function(msg){
	 				if(msg){
	 					setTimeout("window.location.reload()",2000);
	 					box('ok',"删除成功");
	 				}else{
	 					box('error',"删除失败");
	 				}
	 			},
	 			error:function(){
	 				box('error',"网络错误");
	 			}
 			})
 		})
 		
 	})
 })