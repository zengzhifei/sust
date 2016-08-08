/**
 *@author:zengzf
 *2016.03.21
 */
 $(function(){
 	//继续添加
 	$(document).on('click',"#add",function(){
 		var inputid = ($("input").length)/2+1;
		$("table").append("<tr><td><input type='text' name=course"+inputid+" /></td><td><input type='text' name=credit"+inputid+" /></td></tr>");
 	})
 	//提交
 	$(document).on('click','#sub',function(){
 		var data = $("form").serialize();
 		$.ajax({
 			url:'/Createcourse/addcourse',
 			type:'POST',
 			data:data,
 			success:function(msg){
 				if(msg==500){
 					box('error','添加失败')
 				}else{
 					setTimeout("window.location.reload()",2000);
 					box('ok','添加成功');
 				}
 			},
 			error:function(){
 				box('error','网络错误');
 			}
 		})
 	})



 })