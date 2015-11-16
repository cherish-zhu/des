// JavaScript Document

$(".toutiao p").hover(function(){
	$(".toutiao-desc").hide();
	$(".color-red").removeClass("color-red");
	$(this).children().addClass("color-red");
	$(this).next().show();
},function(){
	//$(".color-red").children("a").removeClass("color-red");
	//$(this).children("a").addClass("color-red");
});

$(document).ready(function(){
	$(".nav").posfixed({
		distance:0,
		pos:"top",
		type:"while",
		hide:false
	});             
});