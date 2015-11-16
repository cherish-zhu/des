<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录 - Destroy</title>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/login.css" />
<script type="text/javascript" src="/Static/JQuery/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    $(function () {
		$(".verify").click(function(){
			var newUrl=$(this).attr("src")+"?F="+Math.random();
            $(this).attr("src",newUrl);
		});
        $("input").focus(function () {
            $(this).addClass("inputFocus");
        }).blur(function () {
            $(this).removeClass("inputFocus");
        });
		$("#butt").click(function(){
			var url = "/admin/Public/checkLogin";
			$.post(url,{account:$("#username").val(),password:$("#password").val(),verify:$("#check").val()},function(result){
				if( result.status==1 ){
					location.href = '/admin/Index';
				}else{
					$("#tips").text(result.info);
				}
			},'json');
		});
    });

</script>
</head>

<body>

<div class="login-back">
     
     <div class="login-box">
          <div class="login-left">
            <form id="form1" name="form1" method="post" action="" onsubmit="javascript:return false;">
              <input type="text" name="username" id="username" placeholder="请输入帐号" />
              <input name="password" type="password" id="password" class="ps_input">
              <input type="text" name="cheke" id="check" placeholder="验证码" /><img title="点击刷新"  class="verify" src="/admin/Public/verify"  />
              <input type="submit" name="Button" value="登 陆" id="butt"><font id="tips"></font>
            </form>
          </div>
          <div class="login-right">
               <img src="/logo.png" width="150" height="150" />
               <font class="font">Destroy</font>
          </div>
     </div>

</div>

</body>
</html>
