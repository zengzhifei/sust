/**
 *@author:zengzf
 *2016.03.28
 ***/
 $(function(){
 	//检验账号存在
 	$('#account').focus(function(){
		$("#account").css("border-color","blue");
		$("#account_note").text("*请输入分配的学号");
		$("#account_note").css("color","yellow");
 	}).blur(function(){
 		var reg = /^\d{10,}$/;
 		var account = $("#account").val();
 		if(reg.test(account)){
 			$.ajax({
 				url:'/Register/checkaccount',
 				type:'POST',
 				data:{'account':account},
 				success:function(msg){
 					if(!msg){
			   			$("#account").css("border-color","red");
			 			$("#account_note").text("该学号不存在");
			 			$("#account_note").css("color","red");
			 			$("#account").data("bol",false);						
 					}else{
 						$("#account").css("border-color","");
 						$("#account_note").text("");
 						$("#account").data("bol",true);
 					}
 				}
 			})
 		}else{
  			$("#account").css("border-color","red");
 			$("#account_note").text("请输入正确的学号");
 			$("#account_note").css("color","red");
 			$("#account").data("bol",false);			
 		}
 	});
 	
 	//检验身份证号
 	$("#personId").focus(function(){
		$("#personId_note").text("*请输入身份证号");
		$("#personId_note").css("color","yellow");
 	}).blur(function(){
 		var account  = $("#account").val();
 		var personId = $("#personId").val();
 		$.ajax({
 			url:'/Login/checkpersonid',
 			type:'POST',
 			data:{'account':account,'personId':personId},
 			success:function(msg){
 				if(!msg){
 					$("#personId_note").text("身份证号和学号不对应");
 					$("#personId_note").css("color","red");
 					$("#personId").css("border-color","red");
 					$("#personId").data("bol",false);
 				}else{
 					$("#personId_note").text("");
 					$("#personId").css("border-color","");
 					$("#personId").data("bol",true);
 				}
 			},
 			error:function(msg){
 				box('error','网络错误');
 			}
 		})
 	})
 	//检验新密码格式
 	 $('#newpassword').focus(function(){
		$("#newpassword_note").text("*请输入6-20位字母数字下划线组成的新密码");
		$("#newpassword_note").css("color","yellow");
 	}).blur(function(){
 		var reg = /^\w{6,20}$/;
 		var newpassword = $("#newpassword").val();
 		if(reg.test(newpassword)){
 			$("#newpassword").css("border-color","");
 			$("#newpassword_note").text("");
 			$("#newpassword").data("bol",true);
 		}else{
  			$("#newpassword").css("border-color","red");
 			$("#newpassword_note").text("请输入正确的密码");
 			$("#newpassword_note").css('color','red');
 			$("#newpassword").data("bol",false);			
 		}
 	});
 	 //验证重复密码
 	 $('#repassword').focus(function(){
		$("#repassword_note").text("*请重复密码");
		$("#repassword_note").css("color","yellow");
 	}).blur(function(){
 		var newpassword = $("#newpassword").val();
 		var repassword = $("#repassword").val();
 		if(newpassword && (newpassword==repassword)){
 			$("#repassword").css("border-color","");
 			$("#repassword_note").text("");
 			$("#repassword").data("bol",true);
 		}else{
  			$("#repassword").css("border-color","red");
 			$("#repassword_note").text("密码不一致");
 			$("#repassword_note").css('color','red');
 			$("#repassword").data("bol",false);			
 		}
 	});
 	//提交找回密码
 	$(document).on('click','#sub',function(){
 		if($("#account").data('bol') && $("#newpassword").data('bol') && $("#repassword").data('bol') && $("#personId").data('bol')){
 			$.ajax({
 				url:'/Login/findpsw',
 				type:'POST',
 				data:$("form").serialize(),
 				success:function(msg){
 					if(msg){
 						setTimeout("window.location.href= '/Global/quit'",2000);
 						box("ok",'修改成功');
 					}else{
 						box('error','密码无修改');
 					}
 				},
 				error:function(){
 					box('网络错误');
 				}
 			})
 		}else{
 			box('error','输入有误');
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

 })