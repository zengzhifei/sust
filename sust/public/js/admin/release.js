/**
 *@author:zengzf
 *2016.03.30
 **/

$(function(){
	$("#sub").on("click",function(){
		var title   = $("#releaseTitle").val();
		var content = $("#releaseContent").val();
		if(title){
			$.ajax({
				url:'/Publish/publish',
				type:'POST',
				data:{'title':title,'content':content},
				success:function(msg){
					if(msg==404){
						box('error','主题不能为空');
					}else if(!msg){
						box('error','发布失败');
					}else{
						setTimeout("window.location.reload()",2000);
						box('ok','发布成功');
					}
				},
				error:function(){
					box('error','网络错误');
				}
			})
		}else if(!title){
			box('error','主题不能为空');
		}
	})

})		