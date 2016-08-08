/**
 *@author:zengzf
 *2016.03.22
 */
 $(function(){
 	//添加课程时间
 	$(document).on('click','#sub',function(){
 		var data = $("form").serialize();
 		$.ajax({
 			url:'/Courseinfo/distributetime',
 			type:'POST',
 			data:data,
 			success:function(msg){
 				console.log(msg);
 				if(!msg){
 					box('error','分配失败')
 				}else{
 					setTimeout("window.location.reload()",2000);
 					box('ok','分配成功');
 				}
 			},
 			error:function(){
 				box('error','网络错误');
 			}
 		})

 	})




 })