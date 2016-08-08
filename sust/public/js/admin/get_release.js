/**
 *@author:zengzf
 *2016.03.30
 */
 $(function(){
 	//删除通知
 	$(document).on('click','.deleterelease',function(){
 		var element = $(this);
 		Dialog.confirm('警告：您确认删除该条通知？',function(){
 			$.ajax({
 				url:'/Publish/deletepublish',
 				type:'POST',
 				data:{'releaseid':element.attr("releaseid")},
 				success:function(msg){
 					if(msg==404){
 						box('error','该通知不存在');
 					}else if(!msg){
 						box('error','删除失败');
 					}else{
 						setTimeout("window.location.reload()",2000);
 						box('ok','删除成功');
 					}
 				},
 				error:function(){
 					box('error','网络错误');
 				}
 			})
 		})
 	})


 })