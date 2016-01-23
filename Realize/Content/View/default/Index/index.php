<include  file="public:header" />
<script src="/Realize/Content/View/default/style/js/common.js" type=text/javascript></script>
<link type="text/css" rel="stylesheet" href="/Realize/Content/View/default/style/css/index.css" />

<div class="wrap">
    <div class="left">
    
	<div class="flash-box">
		<h2><b>焦点轮番</b></h2>
		<div class="big-pic" id="SwitchBigPic">
		<?php foreach(getList(1102,6,0,3) as $in => $li){?>
		<a href="<?php echo URL($li['alias'],$li['cid'])?>" blockid="2360"><img src="<?php echo  $li['thumb']?>"></a> 
        <?php }?>
		</div>
		<div class="pic-list_0810">
			<div id="ul_recom">
			<?php foreach(getList(1102,6,0,3) as $in => $li){?>
			  <a <?php if($in == 0) echo 'class="currA"'?> id="SwitchSmaPic_<?php echo $in?>" href="<?php echo URL($li['alias'],$li['cid'])?>" blockid="2360"><img src="<?php echo thumb($li['thumb'])?>"><span><strong>《<?php echo $li['name']?>》<?php echo $li['title']?></strong></span><span><?php echo $li['description']?></span></a> 
            <?php }?>
			</div>
	   </div>
		
	</div>
	
	<script>
			var Today_recom={
					step:42,
					totalcount:6,
					a_pre:"",
					a_next:"",
					ul:"ul_recom"
				};
	
				var IndexRecom={					
					bigpic:"SwitchBigPic",	//大图DIV之ID通用部分	
					step:223,
					smallpic:"SwitchSmaPic",//小图之ID通用部分		
					selectstyle:"currA",	//小图被选中之后的CSS
					pictxt:"",	//配套图片文字
					totalcount:6,					//图片数量	
					autotimeintval:6000,
					objname:"IndexRecom"	//对象名称		
				} ;	
			</script>
    
        <?php foreach(getAllList(5) as $key => $val){?>
        <div class="list">
            <div class="line"><div class="category"><?php echo  $val['name']?></div><?php if(!empty($val['son'])){ foreach($val['son'] as $index => $son){?><a href="<?php echo URL( $son['alias'])?>"><?php echo $son['name']?></a><?php } }else{?><div class="more"><a href="<?php echo URL( $val['alias'])?>">更多..</a></div><?php }?></div>
            <ul>
                <?php foreach($val['list'] as $list){?>
                <li><div class="title"><a href="<?php echo URL($list['cate']['alias'],$list['id'])?>">[<?php echo $list['cate']['name']?>] <?php echo $list['title']?></a></div><span class="datetime"><?php echo date("Y-m-d H:i",$list['create_time'])?></span></li>
                <?php }?>
            </ul>
        </div>
        <?php }?>
    </div>
    <include  file="public:left" />
</div>

<include  file="public:footer" />