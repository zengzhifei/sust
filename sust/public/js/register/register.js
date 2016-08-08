/**
 *@author:zengzf
 *2016.03.24
 ***/
 $(function(){
 	//注册
 	//验证姓名
 	$('#name').focus(function(){
		$("#name").css("border-color","blue");
		$("#name_info").text("*请输入真实姓名,中文或英文");
		$("#name_info").css("color","yellow");
 	}).blur(function(){
 		var reg =/^[\u4e00-\u9fa5|a-zA-Z]+$/;
 		var name = $("#name").val();
 		if(reg.test(name)){
 			$("#name").css("border-color","");
 			$("#name_info").text("");
 			$("#name").data("bol",true);
 		}else{
  			$("#name").css("border-color","red");
 			$("#name_info").text("请输入正确的姓名");
 			$("#name_info").css("color","red");
 			$("#name").data("bol",false);			
 		}
 	});
 	//验证账号
 	 $('#account').focus(function(){
		$("#account").css("border-color","blue");
		$("#account_info").text("*请输入分配的学号");
		$("#account_info").css("color","yellow");
 	}).blur(function(){
 		var reg = /^\d{10,}$/;
 		var account = $("#account").val();
 		if(reg.test(account)){
 			$.ajax({
 				url:'/Register/checkaccount',
 				type:'POST',
 				data:{'account':account},
 				success:function(msg){
 					if(msg){
			   			$("#account").css("border-color","red");
			 			$("#account_info").text("该学号已注册");
			 			$("#account_info").css("color","red");
			 			$("#account").data("bol",false);						
 					}else{
 						 $("#account").css("border-color","");
 						$("#account_info").text("");
 						$("#account").data("bol",true);
 					}
 				}
 			})
 		}else{
  			$("#account").css("border-color","red");
 			$("#account_info").text("请输入正确的学号");
 			$("#account_info").css("color","red");
 			$("#account").data("bol",false);			
 		}
 	});
 	//验证密码
 	 $('#password').focus(function(){
		$("#password").css("border-color","blue");
		$("#password_info").text("*请输入6-20位字母数字下划线组成的密码");
		$("#password_info").css("color","yellow");
 	}).blur(function(){
 		var reg = /^\w{6,20}$/;
 		var password = $("#password").val();
 		var repassword = $("#repassword").val();
 		if(reg.test(password)){
 			if(repassword && (repassword!=password)){
		 		$("#repassword").css("border-color","red");
		 		$("#repassword_info").text("密码不一致");
		 		$("#repassword_info").css("color","red");
		 		$("#password_info").text("");
		 		$("#repassword").data("bol",false);
		 		return;
	 		}
	 		$("#password").css("border-color","");
	 		$("#repassword").css("border-color","");
	 		$("#password_info").text("");
	 		$("#repassword_info").text("");
	 		$("#password").data("bol",true);	
 		}else{
  			$("#password").css("border-color","red");
 			$("#password_info").text("请输入正确的密码");
 			$("#password_info").css("color","red");
 			$("#password").data("bol",false);			
 		}
 	});
 	//验证重复密码
 	 $('#repassword').focus(function(){
		$("#repassword").css("border-color","blue");
		$("#repassword_info").text("*请重复密码");
		$("#repassword_info").css("color","yellow");
 	}).blur(function(){
 		var password = $("#password").val();
 		var repassword = $("#repassword").val();
 		if(password && (password==repassword)){
 			$("#repassword").css("border-color","");
 			$("#repassword_info").text("");
 			$("#repassword").data("bol",true);
 		}else{
  			$("#repassword").css("border-color","red");
 			$("#repassword_info").text("密码不一致");
 			$("#repassword_info").css("color","red");
 			$("#repassword").data("bol",false);			
 		}
 	});
 	//验证验证码
 	$("#code").focus(function(){
		$("#code").css("border-color","blue");
		$("#code_info").text("*请输入验证码");
		$("#code_info").css("color","yellow");
 	}).blur(function(){
 		var code = $("#code").val();
 		if(code){
	 		$.ajax({
	 				url:'/Register/checkcode',
	 				type:'POST',
	 				data:{'code':code},
	 				success:function(msg){
	 					console.log(msg);
	 					if(msg){
	 						$("#code").css("border-color","");
	 						$("#code_info").text("");
	 						$("#code").data("bol",true);
	 					}else{
	 						$("#code").css("border-color","red");
	 						$("#code_info").text("验证码不正确");
	 						$("#code_info").css("color","red");
	 						$("#code").data("bol",false);
	 					}
	 				},
	 				error:function(){
	 					box('error','网络错误');
	 				}
	 		})
	 	}else{
	 			$("#code").css("border-color","red");
	 			$("#code_info").text("验证码不能为空");
	 			$("#code_info").css("color","red");
	 			$("#code").data("bol",false);
	 	}
 	})
 	//提交注册
 	$(document).on('click','#sub',function(){
 		if($("#name").data("bol") && $("#account").data("bol") && $("#password").data("bol") && $("#repassword").data("bol") && $("#code").data("bol")){
 			$.ajax({
 				url:'/Register/goregister',
 				type:'POST',
 				data:$("form").serialize(),
 				success:function(msg){
 					if(msg){
 						window.location.href = msg;
 					}else{
 						box('error',"注册失败");
 					}
 				},
 				error:function(){
 					box('error','网络错误');
 				}
 			})
 		}else{
 			box('error',"输入有误");
 		}
 	})
 	
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