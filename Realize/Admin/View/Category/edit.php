<!DOCTYPE html>
<html>
<head>
<title>菜单管理 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
</head>

<body>
	<div id="wrapper">
		<?php require_once('./Realize/Admin/View/Public/left.php');?>
		<div id="page-wrapper" style="height:979px !important" class="gray-bg dashbard-1">
			<?php require_once('./Realize/Admin/View/Public/top.php');?>
			<div class="wrapper wrapper-content">
            
            <div class="col-lg-6" style="width:100% !important">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>编辑分类</h5>
                            </div>
                            <div class="ibox-content">
                                <form class="form-horizontal m-t" action="/admin/Category/form?id=<?php echo $_GET['id']?>" method="post" id="commentForm">
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">封面图标：</label>
                                        <div class="col-sm-8">
                                            <div id="change-ico" class="cont-check" style="float:left; margin-right:20px; margin-top:0px">选择图标</div>
                                            <div class="cont-img" style="float:left"><img src="<?php if($x['icon'] != '') echo $x['icon']; else echo '/Static/icon/wold.jpg';?>" /></div>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-sm-3 control-label">上级分类：</label>
                                        <div class="col-sm-8">
                                            <select name="parent_id" id="select">
                                              <?php switch($_GET['app']){
												  case 1:
                                                  echo '<option value="1">文章</option>';
												  break;
												  case 2:
												  echo '<option value="2">相册</option>';
												  break;
												  case 3:
												  echo '<option value="3">链接</option>';
												  break;
                                              }?>
                                              <?php echo $options ?>
                                            </select>
                                            </div>
                                    </div>
                                    <?php if($_GET['app'] == 2){?>
                                    <div class="form-group">
                                     <label class="col-sm-3 control-label">相册?</label>
                                        <div class="col-sm-8">
                                          <input type="checkbox" name="album" id="is_album" <?php if($x['type'] == 0) echo 'checked';?>> 
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label category">分类名称：</label>
                                        <div class="col-sm-8">
                                            <input id="name" name="name" minlength="2" type="text" class="form-control" value="<?php echo $x['name']?>" required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">分类别名：</label>
                                        <div class="col-sm-8">
                                            <input id="alias" type="text" class="form-control" name="alias"  value="<?php echo $x['alias']?>"  required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">描述：</label>
                                        <div class="col-sm-8">
                                            <input id="description" type="text" class="form-control" name="description" value="<?php echo $x['description']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">关键字：</label>
                                        <div class="col-sm-8">
                                            <input id="keyword" type="text" class="form-control" name="keyword" value="<?php echo $x['keyword']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">指定视图模板：</label>
                                        <div class="col-sm-8">
                                          <input type="checkbox" name="checkbox" id="check_view"  style="float:left; margin-right:16px" >
                                          <input id="view" type="text" class="form-control" name="view" style="width:200px !important; float:left" value="<?php echo $x['view']?>" disabled> &nbsp;&nbsp;(仅输入名称即可，无须后缀)
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">每页分页显示条数：</label>
                                        <div class="col-sm-8">
                                          <input id="page" type="text" class="form-control" name="page" style="width:200px !important; float:left" value="<?php echo $x['page']?>"> 
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-3">
                                        <input type="hidden" name="thumb" id="thumb" value="<?php echo $x['thumb']?>">
                                        <input type="hidden" name="app" id="app" value="<?php echo $x['app']?>">
                                        <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>  
                               				
			</div>
		</div>
        
                    <div class="footer">
                <div class="pull-right">
                    By：<a href="http://www.destroy.net.cn/" target="_blank">destroy.net.cn</a>
                </div>
                <div>
                    <strong>Copyright</strong> Destroy &copy; 2015
                </div>
            </div>
        </div>
    </div>
        
</body>
    <script src="./admin/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="./admin/js/plugins/validate/messages_zh.min.js"></script>
    <script>
	
	 $("#is_album").click(function(){
        if($(this).is(':checked')) {
            $("#app").val("0");
			$(".category").text("相册名称：");
        }else{
            $("#app").val("<?php echo $_GET['app']?>");
			$(".category").text("分类名称:");
        }
     });
	
	$("#check_view").click(function(){ 
        if($(this).is(':checked')) {
            $("#view").prop("disabled",true); 
	        $("#view").prop("disabled",false);
        }else{ 
            $("#view").prop("disabled",true);  
        } 
    });
        //以下为修改jQuery Validation插件兼容Bootstrap的方法，没有直接写在插件中是为了便于插件升级
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                element.closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorElement: "span",
            errorClass: "help-block m-b-none",
            validClass: "help-block m-b-none"


        });

         //以下为官方示例
        $().ready(function () {
            // validate the comment form when it is submitted
            $("#commentForm").validate();

            // validate signup form on keyup and submit
            $("#signupForm").validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    username: {
                        required: true,
                        minlength: 2
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    topic: {
                        required: "#newsletter:checked",
                        minlength: 2
                    },
                    agree: "required"
                },
                messages: {
                    firstname: "请输入你的姓",
                    lastname: "请输入您的名字",
                    username: {
                        required: "请输入您的用户名",
                        minlength: "用户名必须两个字符以上"
                    },
                    password: {
                        required: "请输入您的密码",
                        minlength: "密码必须5个字符以上"
                    },
                    confirm_password: {
                        required: "请再次输入密码",
                        minlength: "密码必须5个字符以上",
                        equalTo: "两次输入的密码不一致"
                    },
                    email: "请输入您的E-mail",
                    agree: "必须同意协议后才能注册"
                }
            });

            // propose username by combining first- and lastname
            $("#username").focus(function () {
                var firstname = $("#firstname").val();
                var lastname = $("#lastname").val();
                if (firstname && lastname && !this.value) {
                    this.value = firstname + "." + lastname;
                }
            });
        });
    </script>
</html>