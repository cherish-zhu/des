<!DOCTYPE html>
<html>
<head>
<title>菜单管理 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
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
                                <h5>编辑导航</h5>
                            </div>
                            <div class="ibox-content">
                                <form class="form-horizontal m-t" action="/admin/Nav/form?id=<?php echo $_GET['id']?>" method="post" id="commentForm">
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">图标：</label>
                                        <div class="col-sm-8">
                                            <div id="change-ico" class="cont-check" style="float:left; margin-right:20px; margin-top:0px">选择图标</div>
                                            <div class="cont-img" style="float:left"><img src="<?php if($x['thumb'] != '') echo $x['thumb']; else echo '/Static/icon/wold.jpg';?>" /></div>
                                        </div>
                                  </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label">上级导航：</label>
                                        <div class="col-sm-8">
                                            <select name="parent_id" id="select">
                                              <option value="0">顶级导航</option>
                                              <?php echo $options ?>
                                            </select>
                                        </div>
                                  </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">导航名称：</label>
                                        <div class="col-sm-8">
                                            <input id="name" name="name" minlength="2" type="text" class="form-control" value="<?php echo $x['name']?>" required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">链接地址：</label>
                                        <div class="col-sm-8">
                                            <input id="links" type="text" class="form-control" name="links"  value="<?php echo $x['links']?>"  required aria-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">是否在列表中自动显示：</label>
                                        <div class="col-sm-8">
                                            <select name="status" id="select2">
                                              <option value="1"<?php if($x['status'] == 1) echo 'selected=" selected"'?>>是</option>
                                              <option value="0"<?php if($x['status'] == 0) echo ' selected=" selected"'?>>否</option>
                                            </select>
                                        </div>
                                    </div>
                                  <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-3">
                                        <input type="hidden" name="thumb" id="thumb" value="<?php echo $x['thumb']?>">
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