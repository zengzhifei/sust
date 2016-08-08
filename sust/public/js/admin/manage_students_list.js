/**
 *@author:zengzf
 *2016.03.17
 **/

$(function(){
	 //管理员管理学生-查找功能
	$(document).on('click',"#search",function(){
		var keyword = $("#keyword").val();
		var reg = /^[\u4e00-\u9fa5|\w|@|-|\s]*$/;
		if(!reg.test(keyword)){
			box('error',"请输入正确的关键字!");
		}else{
			$.ajax({
				url:"/Managestudents/findstudent",
				type:"POST",
				data:{"key_word":keyword},
				success:function(msg){
					if(msg){
						$("#tablelist").html(msg);
					}
				}
			})
		}
	});
	//删除学生
	$(document).on('click',".delete",function(){
		var element = $(this);
		Dialog.confirm('警告：您确认要删除当前账号吗？',function(){			
			$.ajax({
				url:"/Managestudents/deletestudent",
				type:"POST",
				data:{"account":element.attr("account")},
				success:function(msg){
					if(msg==500){						
						box("error","删除失败!");
					}else if(msg==200){						
					  	setTimeout("window.location.reload()",2000);
					  	box('ok','删除成功');
					}
				},
				error:function(){
					box("error","网络错误!")
				}
			})

		},70,280);
	});


})