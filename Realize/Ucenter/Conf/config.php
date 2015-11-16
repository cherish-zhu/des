<?php

/**
 * UCenter客户端配置文件
 * 注意：该配置文件请使用常量方式定义
 */

define('UC_APP_ID', 1); //应用ID
define('UC_API_TYPE', 'Model'); //可选值 Model / Service
define('UC_AUTH_KEY', 'rP2s"/qpC0|Vv3,`XyHSTu+E}_%1Z6c>K$!4.]~I'); //加密KEY
define('UC_DB_DSN', 'mysql://root:19880614@127.0.0.1:3306/destroy'); // 数据库连接，使用Model方式调用API必须配置此项
define('UC_TABLE_PREFIX', 'des_'); // 数据表前缀，使用Model方式调用API必须配置此项
return array(
    'LOAD_EXT_FILE' => 'functions', // 加载自定义扩展函数库
    'WEB_SITE_CLOSE'=>true,
	'DEFAULT_V_LAYER'=>'View/default'
);