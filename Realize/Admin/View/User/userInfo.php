<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style type="text/css">
input{width:106px !important}
</style>
</head>

<body>
<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="99" rowspan="2">
        <img src="/Static/admin/images/user.jpg" width="74" height="74" />
    </td>
    <td width="701" height="42"><div style="width:200px; height:42px; float:left">所属组:管理员</div></td>
  </tr>
  <tr>
    <td width="701" height="42">
        <div style="width:200px; height:42px; float:left">ID:<?php echo 100000000 + $u['id']?></div>
        <div style="width:500px; height:42px; float:left">账号:<?php echo $u['account']?></div>
    </td>
  </tr>
  <tr>
    <td height="42" colspan="2">
        <div style="width:260px; height:42px; float:left">Email:<?php echo $u['email']?></div>
        <div style="width:260px; height:42px; float:left">手机号码:<?php echo $u['phone']?></div>
        <div style="width:260px; height:42px; float:left">QQ:<?php echo $u['qq']?></div>
    </td>
  </tr>
  <tr>
    <td height="42" colspan="2">
        <div style="width:200px; height:42px; float:left">昵称:<span id="nickname" class="clicker"><?php echo $u['nickname']?></span></div>
        <div style="width:500px; height:42px; float:left">个性签名:<span  id="believe"  class="clicker"><?php echo  !empty($u['believe']) ? $u['believe'] : '-'?></span></div>
    </td>
  </tr>
  <tr>
    <td height="42" colspan="2"><div style="width:200px; height:42px; float:left">出生年月：<span id="birthday" class="birthday clicker"><?php echo $u['birthday']?></span></div></td>
  </tr>
  <tr>
    <td height="42" colspan="2"><div style="width:200px; height:42px; float:left">家庭地址：</div>无</td>
  </tr>
  <tr>
    <td height="42" colspan="2"><div style="width:200px; height:42px; float:left">联系地址：</div>

      <select name="province" id="province">
        <option value="0" >-</option>
      </select>
      <select name="city" id="city">
        <option value="0" >-</option>
        <?php
                       foreach($pro as $key => $val){
                           $sel = '';
                           if($val['cityId'] == $u['city']) $sel = 'selected = "selected"';
                           echo '<option value="'.$val['cityId'].'" '.$sel.' >'.$val['cityName'].'</option>';
                       }
                    ?>
      </select>
      <select name="county" id="county">
        <?php
                       foreach($cit as $k => $v){
                           $sel = '';
                           if($v['districtId'] == $u['county']) $sel = 'selected = "selected"';
                           echo '<option value="'.$v['districtId'].'" '.$sel.' >'.$v['districtName'].'</option>';
                       }
                    ?>
      </select>
      <span id="street  class="clicker""> <?php echo !empty($u['address']) ? $u['address'] : '-'?></span>
    </td>
  </tr>
  <tr>
    <td height="42" colspan="2">
        <div style="width:200px; height:42px; float:left">性别：<span id="sex" class="clicker"><?php if($u['sex'] == 0) echo '女'; elseif($u['sex'] == 0)echo '男';else echo '其他';?></span></div>
        <div style="width:200px; height:42px; float:left">血型：<span id="blood" class="clicker"><?php echo !empty($u['blood']) ? $u['blood'] : '-'?></span></div>
    </td>
  </tr>
  <tr>
    <td height="42" colspan="2">
        <div style="width:200px; height:42px; float:left">真实姓名:<span id="name" class="clicker"><?php echo !empty($u['name']) ? $u['name'] : '-'?></span></div>
        <div style="width:200px; height:42px; float:left">学历:<span id="edu" class="clicker"><?php echo !empty($u['edu']) ? $u['edu'] : '-'?></span></div>
        <div style="width:200px; height:42px; float:left">学校:<span id="school" class="clicker"><?php echo !empty($u['school']) ? $u['school'] :'-'?></span></div>
        <div style="width:200px; height:42px; float:left">职业:<span id="job" class="clicker"><?php echo!empty( $u['job']) ? $u['job'] : '-'?></span></div>
    </td>
  </tr>
  <tr>
    <td colspan="2">个人说明</td>
  </tr>
  <tr>
    <td height="60" colspan="2"><span id="Individual" class="clicker"><?php echo !empty($u['Individual']) ?  $u['Individual'] : '-'?></span></td>
  </tr>
</table>
</body>
<script type="text/dialog"> 
$(function(){
        $("#_birthday").datepicker({
            numberOfMonths:1,//显示几个月  
            showButtonPanel:true,//是否显示按钮面板  
            dateFormat: 'yy-mm-dd',//日期格式  
            clearText:"清除",//清除日期的按钮名称  
            closeText:"关闭",//关闭选择框的按钮名称  
            yearSuffix: '年', //年的后缀  
            showMonthAfterYear:true,//是否把月放在年的后面  
            defaultDate:'2015-08-01',//默认日期  
            minDate:'2011-03-01',//最小日期  
            maxDate:'20201-12-31',//最大日期  
            monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],  
            dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],  
            dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],  
            dayNamesMin: ['日','一','二','三','四','五','六'],  
            onSelect: function(selectedDate) {
                 $("#_birthday").val(selectedDate);  
			}  
	   });    
});  
       $.datepicker.regional['zh-CN'] = {  
        closeText: '关闭',  
        prevText: '<上月',  
        nextText: '下月>',  
        currentText: '今天',  
        monthNames: ['一月','二月','三月','四月','五月','六月',  
        '七月','八月','九月','十月','十一月','十二月'],  
        monthNamesShort: ['一','二','三','四','五','六',  
        '七','八','九','十','十一','十二'],  
        dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],  
        dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],  
        dayNamesMin: ['日','一','二','三','四','五','六'],  
        weekHeader: '周',  
        dateFormat: 'yy-mm-dd',  
        firstDay: 1,  
        isRTL: false,  
        showMonthAfterYear: true,  
        yearSuffix: '年'};  
    $.datepicker.setDefaults($.datepicker.regional['zh-CN']);  
	
	$proId = "<?php echo $u['province']?>";
	
	$.get("/admin/address/province",function(data){
		$.each(data,function(e,i){
			$sel = "";
			if(i.provinceId == $proId) $sel = 'selected = "selected"';
			$("#province").append('<option value="'+i.provinceId+'" '+ $sel+' >'+i.provinceName+'</option>');
		});		
	},"json");
	$("#province").change(function(){
		$id = $(this).val();
		$.get("/admin/address/city?id="+$id,function(data){
			str = '<option value="0">-</option>';
			$.each(data,function(e,i){
				str += '<option value="'+i.cityId+'" '+ $sel+' >'+i.cityName+'</option>';
			$("#city").html(str);
		});
		},"json");
		$.post("/admin/user/update",{key:'province-'+$id},function(ret){
		});
	});
	$("#city").change(function(){
		$id = $(this).val();
		$.get("/admin/address/county?id="+$id,function(data){
			str = '<option value="0">-</option>';
			$.each(data,function(e,i){
				str += '<option value="'+i.districtId+'" '+ $sel+' >'+i.districtName+'</option>';
			$("#county").html(str);
		});
		},"json");
		$.post("/admin/user/update",{key:'city-'+$id},function(ret){
		});
	});
	$("#county").change(function(){
		$id = $(this).val();
	    $.post("/admin/user/update",{key:'county-'+$id},function(ret){
		});
	});
	$(".clicker").live("click",function(){
		 value = $(this).text();
         $(this).html('<input name="textfield" type="text" class="val" size="1" value="'+value+'" />');
		 $(".val").focus();
	});
	
	$(".val").live("blur",function(){
		num = $(this).val();
		key = $(this).parent('span').attr("id");
		//var ex = /^[0-9]\d{0,4}$/;
		//if(!ex.test(num)){
			//alert("请输入一个5位数以内的整数");
			//$(".val").focus();
			//return false;
		//}
		$(this).parent('span').text(num);
		$.post("/admin/user/update",{key:key+'-'+num},function(ret){
		});
	});
	
</script>
</html>