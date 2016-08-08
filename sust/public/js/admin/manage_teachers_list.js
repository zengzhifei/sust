/**
 *@author:zengzf
 *2016.03.17
 **/

$(function(){
	 //管理员管理教师-查找功能
	$(document).on('click',"#search",function(){
		var keyword = $("#keyword").val();
		var reg = /^[\u4e00-\u9fa5|\w|@|-|\s]*$/;
		if(!reg.test(keyword)){
			box('error',"请输入正确的关键字!");
		}else{
			$.ajax({
				url:"/Manageteachers/findteacher",
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
	//修改内容
	$(document).on("dblclick",'.change',function(){
		var name = $(this).attr("name");
		var account = $(this).attr("account");
		var oldValue = $(this).text();
		$(this).replaceWith("<td class='newElement'><input id='newElement' type='text' value="+oldValue+"></td>");
		$("#newElement").blur(function(){
			Dialog.confirm('警告：您确定修改？',function(){
				var newValue = $("#newElement").val();
				$.ajax({
					url:'/Manageteachers/updateteacher',
					type:'POST',
					data:{'account':account,'name':name,'value':newValue},
					success:function(msg){
						if(msg == 500){
							box('error',"密码不可以为空");							
						}else if(!msg){
							box('error','无任何修改');
						}else{
							box('ok',"修改成功");
							$(".newElement").replaceWith("<td class='change' name="+name+" account="+account+">"+msg+"</td>");
						}
					},
					error:function(){
						box('error','网络错误');
					}
				})
			},function(){
				$(".newElement").replaceWith("<td class='change' name="+name+" account="+account+">"+oldValue+"</td>");
			})
		})
		
	});
	//删除信息
	$(document).on('click',".delete",function(){
		var element = $(this);
		Dialog.confirm('警告：您确认要删除当前账号吗？',function(){
			$.ajax({
				url:"/Manageteachers/deleteteacher",
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
	//修改信息
	$(document).on('click',".alter",function(){
		Dialog.confirm("双击姓名,密码,电话,email,key可修改!");
	})

})