<?php

namespace Cms\common;
define('TPL', $G['config']['app']['tpl']);
define('WEBROOT', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);///www/users/HK265413/WEB/站点绝对路径
define('RES', DIRECTORY_SEPARATOR . str_replace(WEBROOT, '', TPL . 'static' . DIRECTORY_SEPARATOR));
define('DATA_LIB', DIRECTORY_SEPARATOR . str_replace(WEBROOT, '', ROOT . 'data' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR));
define('DATA_FILE', DIRECTORY_SEPARATOR . str_replace(WEBROOT, '', ROOT . 'data' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR));
//require_once ROOT.'common'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'table'.DIRECTORY_SEPARATOR.'config.php';


header("Content-Type:text/html;charset=utf-8");
header("X-Powered-By:Erhuo.org");

if (!empty($G['get']['param']['ajax'])) {
    display('json_output.php');

}
$G['config']['common'] = M('Cms\admin\setting')->getConfig();

?>