/**
 *@author:zengzf
 *2016.03.19
 **/

$(function(){
	//添加教师
	//工号
	$("#account").focus(function(){
		$("#account_note").text("*工号由字母数字组成");
		$("#account_note").css("color","yellow");
	}).blur(function(){
		var account = $(this).val();
		var reg = /^[a-zA-Z0-9]+$/;
		if(!reg.test(account)){
			$("#account").css("border-color","red");
			$("#account_note").text("工号格式有误");
			$("#account_note").css("color","red");
			$("#account").data("bol",false);
		}else{
			$.ajax({
				url:'/Manageteachers/checkaccount',
				type:'POST',
				data:{'account':account},
				success:function(msg){
					console.log(msg);
					if(msg){
						$("#account").css("border-color","red");
						$("#account_note").text("该工号已存在,无需添加");
						$("#account_note").css("color","red");
						$("#account").data("bol",false);
					}else{
						$("#account").css("border-color","");
						$("#account_note").text("");
						$("#account").data("bol",true);
					}
				}
			})

		}
	});
	//密码
	$("#psw").focus(function(){
		$("#psw_note").text("*6-15位数字密码下划线")
		$("#psw_note").css("color","yellow");
	}).blur(function(){
		var psw = $(this).val();
		var reg = /^\w{6,15}$/;
		if(!reg.test(psw)){
			$("#psw").css("border-color","red");
			$("#psw_note").text("请输入正确的密码");
			$("#psw_note").css("color","red");
			$("#psw").data("bol",false);
		}else{
			var repsw = $("#repsw").val();
			if(''!=repsw && (psw!=repsw)){
				$("#repsw").css("border-color","red");
				$("#repsw_note").text("密码不一致");
				$("#psw_note").text("");
				$("#psw").data("bol",false);
			}else{
				$("#psw").css("border-color","");
				$("#repsw").css("border-color","");
				$("#psw_note").text("");
				$("#repsw_note").text("");
				$("#psw").data("bol",true);
			}
		}
	});
	//重复密码
	$("#repsw").focus(function(){
		$("#repsw_note").text("*请确认密码")
		$("#repsw_note").css("color","yellow");
	}).blur(function(){
		var psw = $("#psw").val();
		var repsw = $("#repsw").val();
		if(psw !== repsw){
			$("#repsw").css("border-color","red");
			$("#repsw_note").text("密码不一致");
			$("#repsw_note").css("color","red");
			$("#repsw").data("bol",false);
		}else{
			$("#repsw").css("border-color","");
			$("#repsw_note").text("");
			$("#repsw").data("bol",true);
		}
	});
	//添加
	$(document).on('click',"#add",function(){
		if($("#account").data("bol") && $("#psw").data("bol") && $("#repsw").data("bol")){
			var name = $("#name").val();
			var account = $("#account").val();
			var password = $("#psw").val();
			$.ajax({
				url:'/Manageteachers/addteacher',
				type:'POST',
				data:{'name':name,'account':account,'password':password},
				success:function(url){
					if(url){
						window.location.href = url;
					}else{
						box('error',"添加失败!");
					}
				},
				error:function(){
					box('error','添加失败!');
				}
			})
		}
	})

})		