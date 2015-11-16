$(function(){
	$str = $(".tab").text();
	switch ($str) {
		case '常用' : $index = 0; break;
		case '系统' : $index = 1; break;
		case '应用' : $index = 2; break;
		case '扩展' : $index = 3; break;
		case '界面' : $index = 4; break;
		case '用户' : $index = 5; break;
	}
	$("#side-menu>li").each(function(index, element) {
        if(index == ($index*2 + 1)){
			$(this).attr("class","active");
			$(this).children("ul").addClass("in");
			return false;
		}
    });	
	$("#page-wrapper").css({
		'height':'auto',
		'min-height':'979px',
	});
});