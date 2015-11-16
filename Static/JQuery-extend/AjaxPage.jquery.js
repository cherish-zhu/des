// JavaScript Document
$.page=function (e){
	e.data;//数据源
	e.list;//每页多少条
	e.pianyi; //每组多少页
	e.templete;
	e.tag;
	var templete=$(e.templete).html();
	var sumPage = parseInt(e.sum/e.pianyi);//最大页数
	if($.type(e.starStr)=='undefined')  e.starStr = '首页';
	if($.type(e.endStr)=='undefined')   e.endStr = '末页';
	if($.type(e.group)=='undefined')    e.group = 7;
	if($.type(e.tag)=='undefined')      e.tag = 'p';
	var pageIng = 'page-1';
	var yidong = parseInt(e.group/2);
	var thisGroup = e.group+1;
	var strStar = '<'+e.tag+' id="page-star">'+e.starStr+'</'+e.tag+'> <'+e.tag+' id="page-up">'+'上一页'+'</'+e.tag+'><'+e.tag+' id="up-group"><<</'+e.tag+'>';
	var str = '';
	for(var i=0;i<e.group;i++){
		u=i+1;
		str+='<'+e.tag+' id ="page-'+u+'">'+u+'</'+e.tag+'>';
	}
	strEnd='<'+e.tag+' id="next-group">>></'+e.tag+'><'+e.tag+' id="page-next">'+'下一页'+'</'+e.tag+'><'+e.tag+' id="page-end">'+e.endStr+'</'+e.tag+'>';

	this.cf=function(){
$(e.pageID+' '+e.tag).live("click",function(){
		//$(e.pageID+' '+e.tag)=null;
		//alert($(e.pageID+' '+e.tag));
		var pageID=$(this).attr("id");
		var str = '';
		if(pageID=='page-star'){
			pageIng = 'page-1';		
			for(var i=0;i<e.group;i++){
		       u=i+1;
		       str+='<'+e.tag+' id ="page-'+u+'">'+u+'</'+e.tag+'>';
	        } 
		    thisGroup = parseInt(e.group+1);
		}else if(pageID=='page-end'){
			var n = sumPage-e.group+1;
			pageIng = 'page-'+sumPage;	
			for(var i=n;i<=sumPage;i++){
		       str+='<'+e.tag+' id ="page-'+i+'">'+i+'</'+e.tag+'>';
	        }
			thisGroup=parseInt(sumPage-e.group)+1;
		}else if(pageID=='up-group'){			
			if(thisGroup<=e.group){
				thisGroup = e.group+1;
			}
			thisEnd = thisGroup-e.group;
			for(var i=thisEnd;i<thisGroup;i++){
		       str+='<'+e.tag+' id ="page-'+i+'">'+i+'</'+e.tag+'>';
	        }
			thisGroup = thisEnd;
		}else if(pageID=='next-group'){
			thisEnd = thisGroup+e.group;
			for(var i=thisGroup;i<thisEnd;i++){
		       str+='<'+e.tag+' id ="page-'+i+'">'+i+'</'+e.tag+'>';
	        }
			thisGroup = thisEnd;
			if(thisGroup+e.group>sumPage){
				thisGroup=sumPage-e.group+1;
			}
		}else if(pageID=='page-next'){
			pageIng = pageIng.split('-');			
			thisStar = pageIng = parseInt(pageIng[1])+1;
			if(pageIng<1)pageIng=1;
			if(pageIng>sumPage)pageIng=sumPage
			thisStar = thisStar - yidong;
			var thisEnd=thisStar+e.group-1;
			if(	thisStar<=yidong){
				thisStar=1;
				thisEnd =e.group;
			}
			if(thisStar + yidong>=sumPage-yidong){
				thisStar=sumPage-e.group+1;
				thisEnd =sumPage;
			}
			for(var i=thisStar;i<=thisEnd;i++){
		       str+='<'+e.tag+' id ="page-'+i+'">'+i+'</'+e.tag+'>';
	        }
			thisGroup = parseInt(pageIng)+parseInt(yidong);
			pageIng = 'page-'+pageIng;
		}else if(pageID=='page-up'){
			pageIng = pageIng.split('-');			
			thisStar = pageIng = parseInt(pageIng[1])-1;
			if(pageIng<1)pageIng=1;
			if(pageIng>sumPage)pageIng=sumPage
			thisStar = thisStar - yidong;
			var thisEnd=thisStar+e.group-1;
			if(	thisStar<=yidong){
				thisStar=1;
				thisEnd =e.group;
			}
			if(thisStar + yidong>=sumPage-yidong){
				thisStar=sumPage-e.group+1;
				thisEnd =sumPage;
			}
			for(var i=thisStar;i<=thisEnd;i++){
		       str+='<'+e.tag+' id ="page-'+i+'">'+i+'</'+e.tag+'>';
	        }
			thisGroup = parseInt(pageIng)+parseInt(yidong);
			pageIng = 'page-'+pageIng;
		}else{
			var id = $(this).attr("id");
			pageIng = id;
			var id = id.split('-');
			var id = id[1];
			var thisStar = id-yidong;
			var thisEnd = parseInt(id)+parseInt(yidong);
			var str = '';
			if(thisStar<=0) thisStar=1;
			if(thisEnd>=sumPage){
				thisStar=sumPage-e.group+1;
			}
			for(var i=thisStar; i<e.group+thisStar;i++){
				u=i+1;
				str+='<'+e.tag+' id ="page-'+i+'">'+i+'</'+e.tag+'>';
			}
			thisGroup = parseInt(id)+parseInt(yidong);
		}
		$(e.pageID).html(strStar+str+strEnd);		
		$("#"+pageIng).addClass("pagestyle");
		thisPG = pageIng.split('-');
		var thisPG = thisPG[1];
		$.get(e.url+"&sum="+e.pianyi+"&page="+thisPG,function(x){
			var tplStr = '';
			var tem =new Array();
			$.each(x,function(i,u){
				$.each(u,function(n,m){					
					var rst =new RegExp("({"+n+"})","gmi");
					if(typeof(tem[i])=='undefined'){
						tem[i]=templete.replace(rst,m);	
					}else{
						tem[i]=tem[i].replace(rst,m);
					}	   
				});
				$.each(e.data,function(n,m){					
					var rst =new RegExp("({data."+n+"})","gmi");
					tem[i]=tem[i].replace(rst,m);   
				});
                 tplStr+=tem[i];
			});
			$(e.contentID).html(tplStr);
	    },'json');
	})
}
	

	thisPG = pageIng.split('-');
	thisPG = thisPG[1];
	$.get(e.url+"&sum="+e.pianyi+"&page="+thisPG,function(x){
			var tplStr = '';
			var tem =new Array();
			$.each(x,function(i,u){
				$.each(u,function(n,m){					
					var rst =new RegExp("({"+n+"})","gmi");
					if(typeof(tem[i])=='undefined'){
						tem[i]=templete.replace(rst,m);	
					}else{
						tem[i]=tem[i].replace(rst,m);
					}	   
				});
				$.each(e.data,function(n,m){					
					var rst =new RegExp("({data."+n+"})","gmi");
					tem[i]=tem[i].replace(rst,m);   
				});
                 tplStr+=tem[i];
			});
			$(e.contentID).html(tplStr);
	},'json');
	$(e.pageID).html(strStar+str+strEnd);
	$("#"+pageIng).addClass("pagestyle");
}
