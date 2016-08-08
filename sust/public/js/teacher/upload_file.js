/**
 *@author:zengzf
 *2016.03.23
 **/
 $(function(){
 	//上传文件
 	$(document).on('click','#sub',function(){
 		var filename = $("#file_name").val();
 		var fileintro = $("#file_intro").val();
 		var file     = $("#myfile").val();
 		if(filename && file){
 			$("form").submit();
 		}else if(!filename){
 			box('error','文件名不能为空');
 		}else if(!file){
 			box('error','文件不能为空');
 		}

 	})



 })