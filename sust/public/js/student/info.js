/**
 *@author:zengzf
 *2016.03.27
 **/
 $(function(){
 	//提交
 	$(document).on('click','#sub',function(){
 		var account = $("#account").val();
 		var personID = $("#personID").val();
 		var reg = /^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/;
 		if(!reg.test(personID)){
 			box("error","身份号输入有误");
 			return;
 		}
 		if(account){
 			$.ajax({
 				url:'/Information/complete',
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