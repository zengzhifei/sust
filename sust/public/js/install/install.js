//检验输入格式
/**
 *@author:zengzf
 *2016.03.13
 */
$(document).ready(function(){
	//数据库名检验
	$("#database").focus(function(){
						$("#database_note").text("*字母,数字或下划线组成,不能以数字开头(1-10位)");
					}).blur(function(){
						var value = $(this).val();
						var reg       = /^[a-zA-Z]\w{0,9}$/;
						if(value=="" || !reg.test(value)){
							if(value == ""){
								$("#database_info").text("数据库名不可以为空");	
							}else{
								$("#database_info").text("数据库名格式不正确");
							}
								$("#database").data("bol",false);
								$("#database").css("border-color","red");
						}else{
								$("#database_note").text("");
								$("#database_info").text("");
								$("#database").data("bol",true);
								$("#database").css("border-color","#a7b6c4");
							}				
		});
	//管理员名检验
	$("#admin").focus(function(){
					$("#admin_note").text("*字母,数字组成(3-10位)");
			    }).blur(function(){
					var value = $(this).val();
					var reg       = /^[a-zA-Z0-9]{3,10}$/;
					if(value=="" || !reg.test(value)){
							if(value == ""){
								$("#admin_info").text("管理员名不可以为空");	
							}else{
								$("#admin_info").text("管理员名格式不正确");
							}
								$("#admin").data("bol",false);
								$("#admin").css("border-color","red");
						}else{
								$("#admin_note").text("");
								$("#admin_info").text("");
								$("#admin").data("bol",true);
								$("#admin").css("border-color","#a7b6c4");
							}
		});
	//密码检验
	$("#psw").focus(function(){
						$("#psw_note").text("*字母,数字组成(5-15位)");
				}).blur(function(){
						var value = $(this).val();
						var reg       = /^[a-zA-Z0-9]{5,15}$/;
						if(value=="" || !reg.test(value)){
							if(value == ""){
								$("#psw_info").text("密码不可以为空");	
							}else{
								$("#psw_info").text("密码格式不正确");
							}
								$("#psw").data("bol",false);
								$("#psw").css("border-color","red");
						}else{
								$("#psw_note").text("");
								$("#psw_info").text("");
								$("#psw").data("bol",true);
								$("#psw").css("border-color","#a7b6c4");
							}
		});
	//重复密码验证
	$("#repsw").focus(function(){
					$("#repsw_note").text("*请确认密码");
				}).blur(function(){
						var value = $(this).val();
						var pswValue = $("#psw").val();
						if((value=="") || (value!=pswValue)){
								$("#repsw_info").text("密码不一致");
								$("#repsw").data("bol",false);
								$("#repsw").css("border-color","red");
						}else{
								$("#repsw_note").text("");
								$("#repsw_info").text("");
								$("#repsw").data("bol",true);
								$("#repsw").css("border-color","#a7b6c4");
							}
		});
	//发送数据
	$("button").click(function(){
		if($("#database").data("bol") && $("#admin").data("bol") && $("#psw").data("bol") && $("#repsw").data("bol")){
			$("form").submit();
		}
	})

});


/*老方法
function check(elment){
	var name  = $(elment).attr("name");
	var id    = $(elment).attr("id")+"_info";
	var value = $(elment).val();
	switch(name){
		case 'database':
			var reg       = /^[a-zA-Z]\w{0,9}$/;
			var name_info = "数据库";
			break;
		case 'admin':
			var reg       = /^[a-zA-Z0-9]{3,10}$/;
			var name_info = "管理员名";
			break;
		case 'psw':
			var reg       = /^[a-zA-Z0-9]{5,15}$/;
			var name_info = "密码";
			break;
	}
	//验证数据库名和管理员名和密码
	if(reg){
		if(!reg.test(value)){
			$("#"+id).text(name_info+"格式不正确!");
			return false;
		}
	}
	//验证重复密码
	if(name == "repsw"){
		var pswVal = $("#psw").val();
		if(value != pswVal){
			$("#"+id).text("密码不一致!");
			return false;
		}else if(value == "" || pswVal == ""){
			$("#"+id).text("密码不能为空!");
			return false;
		}
	}
	$("#"+id).text("");
	return true;
}
//提交
function subform(){
	var res = $("input").each(function(){
		if(!check(this)){
			return false;
		}
	});
	if(res){
		$("form").submit();	
	}
}

function checkdatabase(input_name,input_value){
				var exg = /^[a-zA-Z]\w{2,9}$/;
				if (!exg.test(input_value)) {
					document.getElementById("database").innerHTML="<font style='color:red'>数据库名格式不正确</font>";
					document.getElementById("databases").value="";
				}else{
					document.getElementById(input_name).innerHTML="<br>";
				}
			}

function check(input_name,input_value){
				
				var exg = /^[a-zA-Z0-9]{3,15}$/g;
				if (!exg.test(input_value)) {
					switch(input_name){
					
						case "adminName":
							document.getElementById("adminName").innerHTML="<font style='color:red'>管理员名格式不正确</font>";
							document.getElementById("admin").value="";
							break;
						case "adminPas":
							document.getElementById("adminPas").innerHTML="<font style='color:red'>管理员密码格式不正确</font>";
							document.getElementById("pas").value="";
							break;
						case "adminRepas":
							document.getElementById("adminRepas").innerHTML="<font style='color:red'>管理员密码格式不正确</font>";
							document.getElementById("repas").value="";
							break;
						default:
							break;
					}
				}else{
					document.getElementById(input_name).innerHTML="<br>";
				}
			}	

function go_on(){
			if((document.getElementById("databases").value && document.getElementById("admin").value && document.getElementById("pas").value && document.getElementById("repas").value) != null){

				if (document.getElementById("pas").value != document.getElementById("repas").value) {
					document.getElementById("adminRepas").innerHTML="<font style='color:red'>您的两次密码输入不相同!</font>";
					document.getElementById("repas").value="";
					return;
				}
					document.getElementById('send').submit();
			}else{
				alert("输入不能为空!");
				return;
			}

		}
*/