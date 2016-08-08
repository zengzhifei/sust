/**
 *@author:zengzf
 *2016.03.20
 ***/
 $(function(){
 	//时间显示
 	jeDate({
		dateCell:"#start_time",
		format:"YYYY-MM-DD",
		isTime:true, 
		minDate:"2010-01-01 00:00:00",
		isClear:true,
		festival:true
	})
	jeDate({
		dateCell:"#end_time",
		format:"YYYY-MM-DD",
		isTime:true, 
		minDate:"2010-01-01 00:00:00",
		isClear:true,
		festival:true
	})
	jeDate.skin("gray");
	//搜索
	$(document).on('click','#search',function(){
		var start_time = $("#start_time").val();
		var end_time   = $("#end_time").val()+" 23:59:59";
		var time_start = start_time.substring(0,19);    
			time_start = time_start.replace(/-/g,'/'); 
			time_start = new Date(time_start).getTime();
		var time_end   = end_time.substring(0,19);
			time_end   = time_end.replace(/-/g,'/');
			time_end = new Date(time_end).getTime();
		if(start_time && end_time && (time_end<time_start)){
			box('error','开始时间不能大于结束时间!');
		}else{
			$.ajax({
				url:"/Manageweb/getcount",
				type:'POST',
				data:{'start_time':start_time,'end_time':end_time},
				success:function(msg){
					if(msg){
						$("#tablelists").html(msg);
					}
				},
				error:function(){
					box('error','网络错误');
				}
			})
		}
	})

 })