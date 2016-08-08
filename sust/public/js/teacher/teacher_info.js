/**
 *@author:zengzf
 *2016.03.29
 **/
 $(function(){
 	//提交
 	$(document).on('click','#sub',function(){
 		var account = $("#account").val();
 		if(account){
 			$.ajax({
 				url:'/Teacherinfo/complete',
 				type:'POST',
 				data:$("form").serialize(),
 				success:function(msg){
 					if(msg){
 						setTimeout("window.parent.location.reload()",2000);
 						box('ok',"修改成功");
 					}else{
 						box('error',"无任何修改");
 					}
 				},
 				error:function(){
 					box('error','网络错误');
 				}
 			})
 		}else{
 			box('error',"账号过期,重新登录");
 		}
 	})


 })