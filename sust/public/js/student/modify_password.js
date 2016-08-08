/**
 *@author:zengzf
 *2016.03.27
 ***/
 $(function(){
 	//修改密码
 	$("#oldpassword").focus(function(){
		$("#oldpassword_note").text("*请输入旧密码");
		$("#oldpassword_note").css("color","yellow");
 	}).blur(function(){
 		var account     = $("#account").val();
 		var oldpassword = $("#oldpassword").val();
 		$.ajax({
 			url:'/Other/checkoldpsw',
 			type:'POST',
 			data:{'account':account,'oldpassword':oldpassword},
 			success:function(msg){
 				if(!msg){
 					$("#oldpassword_note").text("旧密码不正确");
 					$("#oldpassword_note").css("color","red");
 					$("#oldpassword").css("border-color","red");
 					$("#oldpassword").data("bol",false);
 				}else{
 					$("#oldpassword_note").text("");
 					$("#oldpassword").css("border-color","");
 					$("#oldpassword").data("bol",true);
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
 		var repassword  = $("#repassword").val();
 		if(reg.test(newpassword)){
 			if(repassword && (repassword!=newpassword)){
		 		$("#repassword").css("border-color","red");
		 		$("#repassword_note").text("密码不一致");
		 		$("#repassword_note").css("color","red");
		 		$("#newpassword_note").text("");
		 		$("#repassword").data("bol",false);
		 		return;
	 		}
	 		$("#newpassword").css("border-color","");
	 		$("#repassword").css("border-color","");
	 		$("#newpassword_note").text("");
	 		$("#repassword_note").text("");
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
 	//提交修改密码
 	$(document).on('click','#sub',function(){
 		if($("#oldpassword").data('bol') && $("#newpassword").data('bol') && $("#repassword").data('bol')){
 			$.ajax({
 				url:'/Other/modifypassword',
 				type:'POST',
 				data:$("form").serialize(),
 				success:function(msg){
 					if(msg){
 						setTimeout("parent.location.href='/Global/quit'",2000);
 						box("ok",'修改成功');
 					}else{
 						box('error','修改失败');
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

 })