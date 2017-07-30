<?php
//function __autoload($classname)
//{
//global $G;
//if(file_exists(CORE.'class'.DIRECTORY_SEPARATOR.$classname.'.class.php')){
//    require_once CORE.'class'.DIRECTORY_SEPARATOR.$classname.'.class.php';
//}elseif(file_exists(ROOT.'common'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'table'.DIRECTORY_SEPARATOR.$classname.'.php')){
//    require_once ROOT.'common'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'table'.DIRECTORY_SEPARATOR.$classname.'.php';
//$classname::init();
//}elseif(file_exists(ROOT.'common'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$classname.'.class.php')){
//    require_once ROOT.'common'.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$classname.'.class.php';
//}elseif (file_exists(ROOT.$G['get']['d'].DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$classname.'.class.php')){
//    require_once ROOT.$G['get']['d'].DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$classname.'.class.php';
//}elseif (file_exists(ROOT.$G['get']['d'].DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.explode('\\',$classname)[1].'.class.php')){//载入其他模块 类
//    require_once ROOT.$G['get']['d'].DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.explode('\\',$classname)[1].'.class.php';
//}
//    $G['debug']['autoload']=is_array($G['debug']['autoload'])?$G['debug']['autoload']:(array)$G['debug']['autoload'];
//array_push($G['debug']['autoload'],$classname);
//}
function __autoload($classname)
{
    global $G;
    if (strstr($classname, '\\')) {
        $pre_classname = $classname;
        $tmp = explode('\\', $classname);
        $classname = end($tmp);
        $directory = $tmp[count($tmp) - 2];//获取倒数第二个 即目录
    } else {
        $pre_classname = __NAMESPACE__ . $classname;
    }
    if (file_exists(ROOT . 'common' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'table' . DIRECTORY_SEPARATOR . $classname . '.php')) {
        require_once ROOT . 'common' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'table' . DIRECTORY_SEPARATOR . $classname . '.php';
    } elseif (file_exists(ROOT . $directory . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . $classname . '.class.php')) {
        require_once ROOT . $directory . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . $classname . '.class.php';
    } elseif (file_exists(ROOT . $G['get']['d'] . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . $classname . '.class.php')) {
        require_once ROOT . $G['get']['d'] . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . $classname . '.class.php';
//}elseif (file_exists(ROOT.$G['get']['d'].DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.explode('\\',$classname)[1].'.class.php')){//载入其他模块 类
//    require_once ROOT.$G['get']['d'].DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.explode('\\',$classname)[1].'.class.php';
    } elseif (file_exists(ROOT . $directory . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . $classname . '.class.php')) {
        require_once ROOT . $directory . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . $classname . '.class.php';
    }
    array_append($G['debug']['autoload'], $classname);
}

function display($parse)
{
    global $G;
    if (file_exists(TPL . $parse)) {
        $G['route']['redirect']['view'] = $parse;
    } else {
        $route = explode('/', $parse);
        if ($route)
            $G['route']['redirect']['view'] = str_replace(ROOT, '', TPL) . $route['0'] . DIRECTORY_SEPARATOR . $route[1] . '_' . $route['2'] . '.php';
    }
}

function U($string = null, $array = null)
{
    global $G;
    $mvc = explode('/', $string);
    if (is_array($array)) {
        $tmp = array();
        foreach ($array as $key => $value) {
            if(!is_numeric($key)) {
                array_append($tmp, $key);
            }
            array_append($tmp, $value);
        }
        $array = $tmp;
    }
    $url = array_merge($mvc, (array)$array);
    $url = implode('/', $url);
    return $G['config']['app']['siteurl'] . $url;
}

function direct($string, $array = null)
{
    global $G;
    $url = U($string, $array);
    header('location:' . $url);
    exit;
}

if (!function_exists('msg')) {
    function msg($text, $url = null, $urlparam = null, $unsetdefaultparam = false)
    {
        global $G;
        if (!$unsetdefaultparam) {
            $urlparam = array_merge($G['get']['param'], $urlparam);
        }
        if (empty($url)) {
            $url = $G['config']['app']['siteurl'];
        } else {
            $url = U($url, $urlparam);
        }
        $G['send']['tpl']['alertmsg'] = $text;
        $G['send']['tpl']['alerturl'] = $url;
        display('msg.php');
    }
}
if (!function_exists('M')) {
    function M($classname)
    {
        $classname = $classname . 'Model';
        return new $classname;
    }
}
if (!function_exists('T')) {
    function T($classname)
    {
        $nclassname = '\Cms\common\\' . $classname;
        $class = null;
        if (class_exists($nclassname)) {
            $class = new $nclassname();
            $class->set_table($classname);
        } else {
            $class = new \Cms\core\db;
            $class->set_table($classname);
        }

        return $class;
    }
}
if (!function_exists('import')) {
    function import($str)
    {
        global $G;
        if ($G['config']['app']['debug']) {
            $debug = '?' . time();
        }
        $ext = get_extension($str);
        if (strpos($str, '/') >= 0 && file_exists(ROOT . $str)) {
            $prefix = '';
        } else {
            $css_prefix = RES . 'css' . DIRECTORY_SEPARATOR;
            $js_prefix = RES . 'js' . DIRECTORY_SEPARATOR;
        }
        switch ($ext) {
            case 'css':
                $return = '<link rel="stylesheet" type="text/css" href="' . $css_prefix . $str . $debug . '">' . "\r\n";
                break;
            case 'js':
                $return = '<script src="' . $js_prefix . $str . $debug . '"></script>' . "\r\n";
                break;
        }
        return $return;
    }
}
function get_extension($file)
{
    return end(explode('.', $file));
}

function shutdown_function()
{
    global $G;
    $e = error_get_last();
    $G['debug']['error_info']['error'] = $e;
    $G['debug']['error_info']['error_trace'] = debug_backtrace();
    //dump($G['debug']['error_info']);
}

function json_output($param, $type = 'json')
{
    global $G;
    $G['system']['json_output_type'] = $type;
    $G['system']['json_output'] = $param;
}

if (!function_exists('add_tpl_static')) {
    /**
     * @param $static_name 要添加的静态文件的名称
     */
    function add_tpl_static($static_name)
    {
        global $G;
        $ext = get_extension($static_name);
        if (file_exists(TPL . 'static' . DIRECTORY_SEPARATOR . $ext . DIRECTORY_SEPARATOR . $static_name)) {
            array_append($G['tpl']['static'], $static_name);
        } elseif (file_exists(ROOT . $static_name)) {
            array_append($G['tpl']['static'], $static_name);
        }
    }
}
if (!function_exists('get_run_file_name')) {
    function get_run_file_name($filepath)
    {
        $file = end(explode(DIRECTORY_SEPARATOR, $filepath));
        return explode('.', $file);
    }
}
if (!function_exists('template')) {
    function template($path)
    {
        global $C;
        $C['Template'] = new \Cms\core\Template();
        $C['Template']->createTpl($path);
        return $C['Template']->cache_file_name;
    }
}
?>