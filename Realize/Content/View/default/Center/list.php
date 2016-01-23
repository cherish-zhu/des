<include  file="public:header" />
<link type="text/css" rel="stylesheet" href="/Realize/Content/View/default/style/css/list.css" />

<div class="wrap">
    <div class="left">

        <div class="list">
            <div class="line"><?php echo $list['name']?></div>
            <ul>
                <?php foreach($arr as $list){?>
                <li><div class="title"><a href="<?php echo URL($list['alias'],$list['cid'])?>"><?php echo $list['title']?></a></div><span class="datetime"><?php echo date("Y-m-d H:i",$list['create_time'])?></span></li>
                <li style="height:auto; width:640px; margin-left:20px; text-indent:2em; margin-bottom:30px; font-size:13px"><?php echo msubstr(strip_tags($list['center']),0,100)?></li>
                <?php }?>
            </ul>
        </div>
        
        <div class="page"><?php echo $page?></div>

    </div>
    <include  file="public:left" />
</div>

<include  file="public:footer" />