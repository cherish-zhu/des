<?php

/**
 * UCenter客户端配置文件
 * 注意：该配置文件请使用常量方式定义
 */

define('UC_APP_ID', 1); //应用ID
define('UC_API_TYPE', 'Model'); //可选值 Model / Service
define('UC_AUTH_KEY', 'yA!C)vj{YL7~0t^=}da"|u#D>z3UO?[TMl+Gsw&N'); //加密KEY
define('UC_DB_DSN', 'mysql://root:19880614@127.0.0.1:3306/des'); // 数据库连接，使用Model方式调用API必须配置此项
define('UC_TABLE_PREFIX', 'des_'); // 数据表前缀，使用Model方式调用API必须配置此项
