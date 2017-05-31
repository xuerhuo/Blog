<?php

namespace Cms\core;
if (!defined('IN'))
    exit('not in web interface');
date_default_timezone_set('PRC');
$G['time']['core']['starttime'] = getmtime();
define('CORE', dirname(__FILE__) . DIRECTORY_SEPARATOR);


error_reporting(7);
global $G, $C;
//$G['debug']['core']['starttime']=getmtime();
$G['debug']['mem']['core']['startmem'] = memory_get_usage();
$G['get'] = $_GET;
$G['post'] = $_POST;
$G['pathinfo'] = $_SERVER['PATH_INFO'];
require_once CORE . 'class/init.class.php';
//底层
$driver = new init();
register_shutdown_function('shutdown_function');//注册调试函数
$G['sec']['strrep'] = $driver->loadsysconf('sec');
$C['Route'] = new Route();//路由
//$C['app'] = $driver->loadsysclass('app');
//初始化底层
$C['app'] = new app();
//载入配置
$G['config']['app'] = $C['app']->loadconf('app');

//数据库
$G['config']['db'] = $C['app']->loadconf('db');
$driver->checkurl($G);
// $driver->loadsysclass('db');
db::init($G['config']['db']);

//初始化基础环境
if (file_exists(ROOT . 'common' . DIRECTORY_SEPARATOR . 'init.php'))
    require_once ROOT . 'common' . DIRECTORY_SEPARATOR . 'init.php';
//应用mvc层
// $driver->loadsysclass('model');
if (file_exists(ROOT . $C['app']->d . DIRECTORY_SEPARATOR . 'init.php'))
    require_once ROOT . $C['app']->d . DIRECTORY_SEPARATOR . 'init.php';//每个目录初始化init.php  用于加载额外的class function等

$M = $C['app']->initModel();
$controller = $C['app']->initController();
if (file_exists($controller)) {
    require_once $controller;
} else {
    msg('找不到对应的controller文件', 'home/index/index');
}

$G['system']['viewfile'] = $C['app']->initView($G['route']['redirect']['view']);
if (file_exists($G['system']['viewfile'])) {
    require_once $G['system']['viewfile'];
}


//    require_once $C['app']->initController();
//    require_once $C['app']->initView($G['route']['redirect']['view']);

$G['time']['core']['endtime'] = getmtime();
//dump($G['time']['core']['endtime']-$G['time']['core']['starttime']);
function getmtime()
{
    $time = microtime();
    list($usec, $sec) = explode(' ', microtime());
    return (float)$usec + (float)$sec;
}

?>