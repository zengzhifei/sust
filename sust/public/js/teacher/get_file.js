/**
 *@author:zengzf
 *2016.03.23
 **/
 $(function(){
 	//删除文件
 	$(document).on('click','.deletefile',function(){
 		var element = $(this);
 		Dialog.confirm('警告：您确认删除该文件？',function(){
 			$.ajax({
 				url:'/Upload/deletefile',
 				type:'POST',
 				data:{'fileid':element.attr('fileid')},
 				success:function(msg){
 					if(!msg){
 						box('error','删除失败');
 					}else if(msg==404){
 						setTimeout("window.location.reload()",2000);
 						box('error','文件不存在');
 					}else{
 						setTimeout("window.location.reload()",2000);
 						box('ok',"删除成功")
 					}
 				},
 				error:function(){
 					box('error',"网络错误");
 				}
 			})
 		})

 	})



 })