<?php
/*
* 过滤特殊字符(数组)函数
*/
function checkstr($str, $data)
{
    $str = str_replace($data, '', $str);
    return $str;
}

/*
 * data 数组
 * method 要过滤的方法
 * 功能 对数组递归过滤
 */
function array_diyfiter($data, $method)
{

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $ret[strfiter($key, $method)] = array_diyfiter($value, $method);
        } else {
            $ret[strfiter($key, $method)] = strfiter($value, $method);
        }
    }
    return $ret;
}

/*
* 功能 对字符递归过滤
*/
function strfiter($dataf, $methodf)
{
    global $G;
    $data = $dataf;
    $method = explode(',', $methodf);
    foreach ($method as $value) {
        switch ($value) {
            case 'html':
                $data = htmlspecialchars($data);
                break;
            case 'trim':
                $data = trim($data);
                break;
            case 'tag':
                $data = strip_tags($data);
                break;
            case 'addslashes':
                $data = my_addslashes($data);
                break;
            case 'sqlinjection':
                foreach ($G['sec']['strrep'] as $rep) {
                    $data = str_replace($rep, '', $data);
                }
                break;
        }
    }
    // dump($data);
    if ($data != $dataf) {
        $data = strfiter($data, str_replace('html', '', $methodf));
    }

    return $data;
}

/*
 * 自定义添加转义斜杠
 * 已经添加了斜杠的将不再添加
 */
function my_addslashes($str)
{
    $finds = array('\'');
    foreach ($finds as $find) {
        /*$count=substr_count($str,$find);
        for ($i=0;$i<$count;$i++) {
            $postion=strpos($str, $find);
            dump($postion);
            $str=substr_replace($str,'\\'.$find,$postion,1);
        }*/
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str{$i} == $find && $str{$i - 1} != '\\') {
                $str = substr_replace($str, '\\' . $find, $i, 1);
            }
        }
    }
    return $str;
}

?>