// JavaScript Document

$(document).on({
			dragleave:function(e){		//拖离
				e.preventDefault();
				$('.dashboard_target_box').removeClass('over');
			},
			drop:function(e){			//拖后放
				e.preventDefault();
			},
			dragenter:function(e){		//拖进
				e.preventDefault();
				$('.dashboard_target_box').addClass('over');
			},
			dragover:function(e){		//拖来拖去
				e.preventDefault();
				$('.dashboard_target_box').addClass('over');
			}
});

$(function() {
    
//=============================多文件上传===================================================
      $('#uploadify').uploadify({
				height        : 39,
				width         : 120,
				auto:true,
				formData     : {
					timestamp :'',//< ? php echo time();?>album_id
					cate_id     :  $("#album_id").text(),//< ?php echo md5('unique_salt' . $timestamp);?>
				},
				 swf      : '/Static/uploadify/uploadify.swf',
			 	 uploader : '/admin/Upload/index/',
				 buttonText: '上传',
				 queueID :'fileQueue',//<div class="img"><img src="/admin/images/thumb.jpg" /><div class="img-set"><div class="pic-name">name</div><div style="float:right;" id="imgset" class=""><span id="bj">+</span>&nbsp;<span id="sc">×</span></div></div><div id="${fileID}" class="uploadify-queue-item"><div class="uploadify-progress-bar"></div></div></div>
				 itemTemplate : ' <li class="upd-new"><img width="150" height="150" src="/Data/Uploads/thumb-5.jpg" /><div id="${fileID}" class="uploadify-queue-item"><div class="uploadify-progress-bar"></div></li>',
				 onInit:function(){var bid=1;},
				 onSelect : function(file) {
					
				},
			    onQueueComplete : function(queueData) {
                     //alert(queueData.uploadsSuccessful + ' 个文件上传成功.');
			         $(".pic_list").each(function(i,e){
					     if(i>=21){
						     $(this).closest("li").remove();
					     }
				     });
               },
			   onUploadStart:function(){//当开始上传时改变url
				  // $('#file_upload').uploadify('settings','uploader',baseURL+'/upload/?aid='+aid)
			    },
			   onUploadSuccess : function(file, data, response) {//上传成功
			         var data = eval("("+data+")");
				     $(".upd-new img[src$='thumb-5.jpg']:eq(0)").attr("src",data.thumb);
               }
      });
	  
	  //========================拖拽上传=============================================================

      var box = document.getElementById('image'); //获得到框体
		
      box.addEventListener("drop",function(e){
			
			e.preventDefault(); //取消默认浏览器拖拽效果
			var aid = $(this).attr("class");
			var fileList = e.dataTransfer.files; //获取文件对象
			//fileList.length 用来获取文件的长度
			$.each(fileList,function(i,e){
			    var img = window.webkitURL.createObjectURL(e);
			    var str = '<div class="img"><div id="${fileID}" class="uploadify-queue-item"><div class="uploadify-progress-bar"></div></div><img src="'+img+'" /><div class="img-set"><div class="pic-name">name</div><div style="float:right;" id="imgset" class="'+u.aid+'"><span id="bj">+</span>&nbsp;<span id="sc">×</span></div></div></div>';
			    $("#image").prepend(str); 
				xhr = new XMLHttpRequest();
				xhr.addEventListener("load", function(evt){//上传成功
		
				   $("#image .img").each(function(i,e){
					    if(i>=21){
						    $(this).remove();
					    }
				    });
				    setTimeout(function(){
						$('.uploadify-progress-bar').remove()
					},2000);					
				}, false);
				xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                         var percentComplete = Math.round(evt.loaded * 100 / evt.total);
                         $('.uploadify-progress-bar').css('width', percentComplete.toString() + '%');
                    }
                }, false);//上传进度
				var uploadUrl = "/admin/upload/?aid="+aid;
		     	xhr.open("post", uploadUrl, true);
			    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");		
			    var fd = new FormData();
				fd.append('Filedata', e);
				xhr.send(fd);
			});
						
      },false);
	  
});