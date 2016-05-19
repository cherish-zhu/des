<!DOCTYPE html>
<html>
<head>
<title>Dostroy 搜索 - </title>
<style type="text/css">
*{padding: 0; margin: 0 auto}
body{padding: 0px; margin: 0px; text-align: center}
.top{width: 100%; height:100px; border-bottom:1px #CCCCCC solid; line-height:100px}
.search{width:500px; height:40px}
#search{width:80px; height:30px}
.search input{width:300px; height:26px}
.line{width:960px; height:30px; line-height:30px; color:#999; font-size:12px; text-align:left}
.wrap{width:960px; height:auto; text-align:left; margin-top:26px}
.left{width:580px; min-height:60px; height:auto; float:left;}
.right{width:300px; height:auto; float:left; margin-left:80px}
.list{width:100%; height:120px; margin-bottom:30px}
.title{width:100%; height:36px; line-height:36px}
.content{width:100%; line-height:30px; height:auto; font-size:13px}
.link{width:100%; height:28px; line-height:28px}
.link a{color:#096; text-decoration:none}
.right ul{list-style-type:none}
.right li{line-height:36px}
.right li a{text-decoration:none; color: #09C; font-size:14px}
.page{width:960px; height:50px; line-height:50px; text-align:left; margin-top:50px}
.clear{width:100%; height:1px; clear:both}
</style>
</head>

<body>
<div class="top"> 
    <div class="search"><input name="keyword" type="text" class="keyword" value="<?php echo $_GET['keyword']?>"><button id="search">搜索</button></div>
</div>
<div class="line">找到相关结果约<?php echo $num?>个</div>

<?php $i = siteTitle('host_url');?>
<div class="wrap">
    <div class="left">
    <?php foreach($row as $key => $val){?>
        <div class="list">
            <div class="title"><a href="<?php echo $i['value']?>/<?php $cat = getCategory((int)$val['cate_id']); echo $cat['alias']?>/<?php echo $val['id']?>.html" target="_blank"><?php echo $val['title']?></a></div>
            <div class="content"><?php echo msubstr(strip_tags($val['center']), $start=0, 100, "utf-8", true)?></div>
            <div class="link"><a href="<?php echo $i['value']?>/<?php $cat = getCategory((int)$val['cate_id']); echo $cat['alias']?>/<?php echo $val['id']?>.html" target="_blank"><?php echo $i['value']?>/<?php $cat = getCategory((int)$val['cate_id']); echo $cat['alias']?>/<?php echo $val['id']?>.html</a></div>
        </div>
    <?php }?>
    </div>
    <div class="right">
    <b>热门搜索</b>
    <ul>
    <li><a href="?keyword=destroy">Destroy</a></li>
    </ul>
    </div>
    <div class="clear"></div>
</div>

<div class="page"><?php echo $page?></div>
</body>
<script src="/Static/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
$(function(){
	$("#search").click(function(){
		$keyword = $(".keyword").val();
		location.href = '/search.html?keyword='+$keyword;
	});
});
</script>
</html>