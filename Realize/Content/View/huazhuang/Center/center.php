<include  file="public:header" />
<link rel="stylesheet" href="/Static/style/meizhuang/css/content.css" />

<div class="wrap">
<div class="clear"></div>

<div class="mian">
    <div class="content-path"><i class="teal home icon"></i><a href="/">首页</a> <i class="angle right icon"></i> &nbsp; <a href="/<?php echo $cate['alias']?>"> <?php echo $cate['name']?></a><span style="float:right"><a href="javascript:history.go(-1);">返回</a></span></div>
    <div class="content-title"><h1><?php echo $center['title']?></h1></div>
    <div class="content-info">来源：美妆技术网 | 发布时间：<?php echo date("Y-m-d",$center['create_time'])?></div>
    <div class="content-desc"><?php echo $center['description']?>..</div>
    <div class="content-wrap"><?php echo $center['center']?></div>
     <div class="clear"></div>
     <div class="clear"></div>
     <div class="content-info"><i class="large heart icon" title="踩"></i><?php echo $center['foot']?><i class="large thumbs up outline icon"  title="赞"></i> <?php echo $center['praise']?></div>
     <div class="cn">猜你喜欢：</div>
     <div class="clear"></div>
     <div class="clear"></div>
</div>
<div class="toutiao">
          <div class="toutiao-title">热点排行</div>
          <?php foreach ($hot as $hotKey => $ht){?>
          <p><a href="/<?php echo $ht['cate_alias']?>/id/<?php echo $ht['id']?>"><?php echo $ht['title']?></a></p>
          <?php }?>
</div>


<include file="public:left" />

<div class="clear"></div>
</div>
<script type="text/javascript">
$(".heart").click(function(){
	$.get("/Content/Center/foot?id=<?php echo $center['id']?>",function(ret){
	    alert('骄傲地留下一只脚印');
    });
});
$(".outline").click(function(){
	$.get("/Content/Center/praise?id=<?php echo $center['id']?>",function(ret){
	    alert('又被赞了一次');
    });
});
</script>
<include file="public:footer" />