<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/8/4
 * Time: 14:18
 */

namespace Org\Util;


class Sec
{
    public static $config=array(
        '<',
        '>',
        '0x',
        '(',
        ')',
        '\\',
        '/',
        'and',
        ':',
        '?',
        '-',
        '\'',
        '"',
        ' ',
        '%',
        '*',
    );
/*
* 过滤特殊字符(数组)函数
*/
public static function checkstr($str, $data)
{
    $str = str_replace($data, '', $str);
    return $str;
}

/*
 * data 数组
 * method 要过滤的方法
 * 功能 对数组递归过滤
 */
public static function array_diyfiter($data, $method)
{

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $ret[self::strfiter($key, $method)] = self::array_diyfiter($value, $method);
        } else {
            $ret[self::strfiter($key, $method)] = self::strfiter($value, $method);
        }
    }
    return $ret;
}

/*
* 功能 对字符递归过滤
*/
public static function strfiter($dataf, $methodf)
{
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
                $data = self::my_addslashes($data);
                break;
            case 'sqlinjection':
                foreach (self::$config as $rep) {
                    $data = str_replace($rep, '', $data);
                }
                break;
        }
    }
    if ($data != $dataf) {
        $data = self::strfiter($data, str_replace('html', '', $methodf));
    }
    return $data;
}

/*
 * 自定义添加转义斜杠
 * 已经添加了斜杠的将不再添加
 */
public static function my_addslashes($str)
{
    $finds = array('\'');
    foreach ($finds as $find) {
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str{$i} == $find && $str{$i - 1} != '\\') {
                $str = substr_replace($str, '\\' . $find, $i, 1);
            }
        }
    }
    return $str;
}

    /**引入discuz的数据库语句格式化
     * @param $sql
     * @param $arg
     * @param bool $safe_check
     * @return string
     */
    public static function format($sql, $arg, $safe_check=true) {
        $check_method[] = 'sqlinjection';//默认检查注入
        if(IS_POST){
            $check_method[] = 'html';//如果有post再增加html过滤
        }
        $check_method = implode(',',$check_method);

        $count = substr_count($sql, '%');
        if (!$count) {
            return $sql;
        } elseif ($count > count($arg)) {
            die('SQL string format error! This SQL need "' . $count . '" vars to replace into.');
        }

        $len = strlen($sql);
        $i = $find = 0;
        $ret = '';
        while ($i <= $len && $find < $count) {
            if ($sql{$i} == '%') {
                $next = $sql{$i + 1};
                if ($next == 't') {
                    $ret .= self::table($arg[$find]);
                } elseif ($next == 's') {
                 //   $ret .= self::quote(is_array($arg[$find]) ? serialize($arg[$find]) : (string) $arg[$find]);
                $ret.= self::strfiter($arg[$find],$check_method);
                } elseif ($next == 'f') {
                    $ret .= sprintf('%F', $arg[$find]);
                } elseif ($next == 'd') {
                    $ret .= sprintf("%d",$arg[$find]);
                } elseif ($next == 'i') {
                    $ret .= $arg[$find];
                } elseif ($next == 'n') {
                    if (!empty($arg[$find])) {
                        $ret .= is_array($arg[$find]) ? implode(',', self::quote($arg[$find])) : self::quote($arg[$find]);
                    } else {
                        $ret .= '0';
                    }
                } else {
                    $ret .= self::quote($arg[$find]);
                }
                $i++;
                $find++;
            } else {
                $ret .= $sql{$i};
            }
            $i++;
        }
        if ($i < $len) {
            $ret .= substr($sql, $i);
        }
        return $ret;
    }

    private static function table($find)
    {
        return C('DB_PREFIX').$find;
    }

    private static function quote($find)
    {
    }
}