//javascript Document
function meizhuang(){	
	this.init();
}
meizhuang.prototype = {
	constructor: meizhuang,
	init: function(){		
		this._initBackTop();
	},	
	_initBackTop: function(){
		
		var $backTop  ='<div class="cbbfixed">'+
						'<a class="cweixin cbbtn">'+
							'<span class="weixin-icon"></span><div></div>'+
						'</a>'+
						'<a title="添加到收藏夹" href="javascript:addToFav()"; class="shouc cbbtn">'+
							'<i class="sc star icon"></i><div></div>'+
						'</a>'+
						'<a class="gotop cbbtn">'+
							'<span class="up-icon"></span>'+
						'</a>'+
						'<div class="fx"><div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><div></div>'+
					'</div>'
		$("body").append($backTop);
		
		$(".gotop").on('click',function(){
			$("html, body").animate({
				scrollTop: 0
			}, 120);
		});

		var timmer = null;
		$(window).bind("scroll",function() {
            var d = $(document).scrollTop(),
            e = $(window).height();
			w = $(window).width();
			r = (w - 980)/2 - 60;
            0 < d ? $(".cbbfixed").css({"bottom":"160px","right":r+"px"}) : $(".cbbfixed").css({"bottom":"-180px"});
			clearTimeout(timmer);
			timmer = setTimeout(function() {
                clearTimeout(timmer)
            },100);
	   });
	}
	
}

function addToFav(){
        var url = "http://xxx.xxx.xxx";
        var title = "xxxxxx";
                
        if (window.sidebar) { // Mozilla Firefox Bookmark
                window.sidebar.addPanel(title, url,"");
        } else if( window.external ) { // IE Favorite
               // window.external.addFavorite( url);
				 alert('您的浏览器不支持一键收藏，请按 Ctrl + D 快捷键将本页添加到收藏夹');
        } else if(window.opera) { // Opera 7+
                return false; // do nothing
        } else { 
                 alert('您的浏览器不支持一键收藏，请按 Ctrl + D 快捷键将本页添加到收藏夹');
        }
}

var meizhuang = new meizhuang();