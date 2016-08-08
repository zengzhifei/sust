/**
 *@author:zengzf
 *2016.03.29
 **/
 $(function(){
 	//修改信息
	$(document).on("dblclick",'.change',function(){
		var name = $(this).attr("name");
		var account = $(this).attr("account");
		var oldValue = $(this).text();
		$(this).replaceWith("<td class='newElement'><input id='newElement' type='text' value="+oldValue+"></td>");
		$("#newElement").blur(function(){
			Dialog.confirm('警告：您确定修改？',function(){
				var newValue = $("#newElement").val();
				$.ajax({
					url:'/Admininfo/updateadmin',
					type:'POST',
					data:{'account':account,'name':name,'value':newValue},
					success:function(msg){
						if(msg==404){
							box("error","账号已过期，重新登录");
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



 })