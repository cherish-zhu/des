<?php
/**
 * 系统配文件
 * 所有系统级别的配置
 */
return array(
    /* 模块相关配置 */
    'AUTOLOAD_NAMESPACE' => array('Addons' => ONETHINK_ADDON_PATH), //扩展模块列表
    'DEFAULT_MODULE'     => 'Content',
    'MODULE_DENY_LIST'   => array('Common','User' ),
    'MODULE_ALLOW_LIST'   => array('Content','Ucenter'),

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => '#>ziw+*@RH<.B?Gd:~y]s%rI/=3TNUgm54QO`e|p', //默认数据加密KE //默认数据加密KEY

    /* 调试配置 */
    'SHOW_PAGE_TRACE' => false,

//路由
    'URL_ROUTER_ON'   => true,
    'URL_MAP_RULES'=>array(
        'admin'   => 'admin/Index/index',
        'Ucenter' => 'Ucenter/Index/index',
    ),
    'URL_ROUTE_RULES'=>array(
        'admin/:c/:a'                   => 'admin/:1/:2',
        'Ucenter/:c/:a'                 => 'Ucenter/:1/:2',
        'Install/:c/:a'                 => 'Install/:1/:2',
        'admin/:id'                     => 'admin/:1/index',
        'Ucenter/:id'                   => 'Ucenter/:1/index',
        ':alias^admin/:id'              => 'Content/Center/:1?id=:2',
        ':alias^Ucenter/:id'            => 'Content/Center/:1?id=:2',
        ':alias^admin'                  => 'Content/Center/:1',
        ':alias^Ucenter'                => 'Content/Center/:1',      
    ),

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1000, //最大缓存用户数
    'USER_ADMINISTRATOR' => 1, //管理员用户ID

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => true, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 3, //URL模式
    'VAR_URL_PARAMS'       => '', // PATHINFO URL参数变量
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    /* 全局过滤配置 */
    'DEFAULT_FILTER' => '', //全局过滤函数

    /* 数据库配置 */
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => '127.0.0.1', // 服务器地址
    'DB_NAME'   => 'destroy', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '123456',  // 密码
    'DB_PORT'   => '3306', // 端口
    'DB_PREFIX' => 'des_', // 数据库表前缀

    /* 文档模型配置 (文档模型核心配置，请勿更改) */
    'DOCUMENT_MODEL_TYPE' => array(2 => '主题', 1 => '目录', 3 => '段落'),
);