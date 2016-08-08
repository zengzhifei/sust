/**
 *@author:zengzf
 *2016.03.30
 ****/
 var t = n = 0, count;
 $(function(){
 	//图片旋转
 	function showAuto(){
		n = n >=(count -1) ? 0 : ++n;
		$("#imgnum li").eq(n).trigger('click');
	}

	count=$("#imgshow img").length;
	$("#imgshow img:not(:first-child)").hide();
	$("#imgnum li").click(function() {
		var i = $(this).text() -1;//获取Li元素内的值，即1，2，3，4
		n = i;
		if (i >= count) return;
		$("#imgshow img").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
		$(this).toggleClass("on");
		$(this).siblings().removeAttr("class");
	});
	t = setInterval(function(){showAuto();}, 4000);
	$("#imgnum").hover(function(){clearInterval(t)}, function(){t = setInterval(function(){showAuto();}, 4000);});



 	//通知显示
 	$.ajax({
 		url:'/Index/publishshow',
 		type:'POST',
 		data:null,
 		success:function(publish){
 			if(publish){
 				var publishinfo = JSON.parse(publish);
				$("#publish").html(publishinfo[0]);
				$("#publishcontent").html(publishinfo[1]);
 			}
 		}
 	})
 	//展示信息
 	var showTemp = 1;
 	$("#show_info").on('click',function(){
 		$("#publish").toggle(500);
 		if(showTemp%2==1){
 			$(this).css("color",'red');
 		}else{
 			$(this).css("color",'');
 		}
 		++showTemp;
 	});

 	//跳转信息
 	$(document).on('click',".jumppublish",function(){
 		var publishid = $(this).attr("publishid");
 		$("#publishcontent-show").hide(300);
 		$("#publishcontent-show").show(800);
 		$("#publishcontent > div").each(function(){
 			if($(this).attr("publishid")==publishid){
 				$("#publishcontent-show").html($(this)[0].outerHTML);
 			}
 		});

 	});

 	//关闭信息
 	$(document).on('click',".closeinfo",function(){
 		$("#publishcontent-show").hide(700);
 	});

 	//页面跳转
 	$("a").on('click',function(){
 		var href=$(this).attr("href");
 		$(this).removeAttr("href");
 		$("body").animate({"opacity":"0"},300,function(){
 			window.location.href=href;
 		});
 	})
 })