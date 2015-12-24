<!DOCTYPE html>
<html>
<head>
<title>系统首页 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
            
            <div id="tips">
	<i class="circular inverted teal large direction basic icon"></i>    <b>Destroy</b> 欢迎您，<?php echo $_SESSION['loginUserName']?>! 			
</div><p><br /></p><p></p>
            
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-success pull-right">总数</span>
                                <h5>内容</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{$artist}</h1>
                                <!--div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i>
                                </div-->
                                <small>内容总数</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-info pull-right">总数</span>
                                <h5>用户数量</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{$fans}</h1>
                                <!--div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i>
                                </div-->
                                <small>注册用户数</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-primary pull-right">本周</span>
                                <h5>最新用户</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">{$new}</h1>
                                <div class="stat-percent font-bold text-navy">{$new/$fans}% <i class="fa fa-level-up"></i>
                                </div>
                                <small>本周注册用户数</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <span class="label label-danger pull-right">本周</span>
                                <h5>活跃用户</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">80,600</h1>
                                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i>
                                </div>
                                <small>本周活跃用户数</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!--div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>交易量</h5>
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-xs btn-white active">天</button>
                                        <button type="button" class="btn btn-xs btn-white">月</button>
                                        <button type="button" class="btn btn-xs btn-white">年</button>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="flot-chart">
                                            <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <ul class="stat-list">
                                            <li>
                                                <h2 class="no-margins">2,346</h2>
                                                <small>订单总数</small>
                                                <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i>
                                                </div>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">4,422</h2>
                                                <small>最近一个月订单</small>
                                                <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i>
                                                </div>
                                                <div class="progress progress-mini">
                                                    <div style="width: 60%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <h2 class="no-margins ">9,180</h2>
                                                <small>最近一个月销售额</small>
                                                <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i>
                                                </div>
                                                <div class="progress progress-mini">
                                                    <div style="width: 22%;" class="progress-bar"></div>
                                                </div>
                                            </li>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div-->


                

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

</html>