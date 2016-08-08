/***
 *author:zengzf
 *2016.03.13
 **/
$(document).ready(function(){
	//验证账号格式
	$("#account").focus(function(){
					$(this).css("border-color",'blue');
				}).blur(function(){
					var value = $(this).val();
					var reg = /^[a-zA-Z0-9]{3,15}$/;
					if(value=="" || !reg.test(value)){
						$("#accountNote").text("请输入正确的账号!");
						$("#account").css("border-color","red");
						$("#account").data("bol",false);
					}else{
						var radio = $("input[name='radio']:checked").val();
						$.ajax({
							url:"/Login/checkin",
							type:"POST",
							data:{"radio":radio,"account":value},
							success:function(msg){
								if(msg==404){
									$("#accountNote").text("该账号不存在");
									$("#account").css("border-color","red");
									$("#account").data("bol",false);
								}else{
									$("#account").css("border-color","");
									$("#accountNote").text("");
									$("#account").data("bol",true);
									};	
								},
							})
						}
				   });
        
	//验证密码格式
	$("#psw").focus(function(){   
				$(this).css("border-color",'blue');
			}).blur(function(){
					var value = $(this).val();
					if(value==""){
						$("#pswNote").text("请输入正确的密码!");
						$("#psw").css("border-color","red");
						$("#psw").data("bol",false);
					}else{
						$("#pswNote").text("");
						$("#psw").css("border-color","");
						$("#psw").data("bol",true);
					}
				});
	//提交验证
	$("button").click(function(){
		if($("#account").data("bol") && $("#psw").data("bol")){
			var radio = $("input[name='radio']:checked").val();
			var account = $("#account").val();
			var password = $("#psw").val();
			$.ajax({
				url:"/Login/check",
				type:"POST",
				data:{"radio":radio,"account":account,"password":password},
				success:function(msg){
					if(!msg){
						box('error',"账号或密码错误!");
					}else if(msg==500){
						Dialog.confirm('警告：已有账号登录，是否先退出已登录账号？',function(){
							$.ajax({
								url:'/Login/loginout',
								type:'POST',
								data:null,
								dataType:'json',
								success:function(msg){
									if(msg){
										window.location.reload();
									}
								},
								error:function(){
									box("error",'网络错误');
								}
							})
						})
					}else{
						window.location.href=msg;
					}
				},
				error:function(msg){
					box('error',"登录失败!");
				}
			})
		}
	});
	 	
	//页面跳转
 	$("a").on('click',function(){
 		var href=$(this).attr("href");
 		$(this).removeAttr("href");
 		$("body").animate({"opacity":"0"},300,function(){
 			window.location.href=href;
 		});
 	})

 	//回车事件
 	document.body.onkeydown = function (e) { 
		var theEvent = window.event || e; 
		var code = theEvent.keyCode || theEvent.which; 
		if (code == 13) {
			$("input").blur();
			$("button").trigger("click"); ;
		} 
	}

})

