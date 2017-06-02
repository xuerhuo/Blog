<?php
function url($arrayRpair = null, $arrayUrl = null)
{
    if (empty($arrayUrl)) {
        $arrayUrl = $_GET;
    }
    $root = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

    foreach ((array)$arrayRpair as $key => $value) {
        $arrayUrl[$key] = $value;
    }

    $status = 1;
    foreach ((array)$arrayUrl as $k => $v) {
        if ($status) {
            $url[all] = $root . '?' . $k . '=' . $arrayUrl[$k];
            $status = 0;
        } else {
            $url[all] = $url[all] . '&' . $k . '=' . $arrayUrl[$k];
        }
    }
    return $url[all];
}

function page(&$arrayRes, $pageSize, $pageGet = 'p')
{
    /*转载请注明出处http://erhuo.org/?p=1316*/


    $listNum = count($arrayRes);
    $pageNum = ceil($listNum / $pageSize);//计算得出总页数
    $p = (int)$_GET[$pageGet];
    if ($p < 1)
        $p = 1;
    if ($p > $pageNum)
        $p = $pageNum;


    $first = 1;
    $last = $pageNum;
    if ($p < $pageNum)
        $next = $p + 1;
    if ($p > 1) {
        $previous = $p - 1;
    }

    $start = ($p - 1) * $pageSize;
    for ($i = 0, $j = 0; $i < $pageSize && ($i + $start) < $listNum; $i++) {
        $temp[$j] = $arrayRes[$start + $i];
        $j++;
    }
    $arrayRes = $temp;
    if ($pageNum > 1) {
        if ($p > 2)
            $pageStr = $pageStr . '<a href="' . url(array($pageGet => 1)) . '">首页</a>';
        if ($previous)
            $pageStr = $pageStr . '<a href="' . url(array($pageGet => $previous)) . '">' . '上一页' . '</a>';
        $pageStr = $pageStr . '<a href="#">' . $p . '</a>/' . $last;
        if ($next)
            $pageStr = $pageStr . '<a href="' . url(array($pageGet => $next)) . '">' . '下一页' . '</a>';
        if ($p < $pageNum - 1)
            $pageStr = $pageStr . '<a href="' . url(array($pageGet => $pageNum)) . '">末页</a>';
    }
    return $pageStr;
}

function dump($var, $echo = true, $label = null, $strict = true)
{
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    } else
        return $output;
}

function scanpath($path, $except = null, &$data = null)
{
    $except = is_array($except) ? $except : array($except);
    $temp = scandir($path);
    foreach ($temp as $v) {
        if ($v != '.' && $v != '..') {
            if (is_dir($path . $v)) {
                if (!in_array($path . $v . DIRECTORY_SEPARATOR, $except))
                    scanpath($path . $v . DIRECTORY_SEPARATOR, $except, $data);
            } else {
                if (!in_array($path . $v, $except))
                    $data[] = $path . $v;
            }
        }
    }
    return $data;
}

function zippath($path, $output, $except = null, $debug = false)
{
    $filelist = scanpath($path, $except);
    $crtdir = dirname(__FILE__);
    $zip = new zipArchive();
    if ($zip->open($output, ZipArchive::OVERWRITE) === TRUE) {
        foreach ($filelist as $file) {
            $file = str_replace(ROOT, '', $file);
            if (!$zip->addFile($file)) {
                $return[] = $file;
            }
        }
        $zip->close();
    } else {
        return -1;
    }
    if ($debug)
        return $return;
    if (file_exists($output))
        return true;
    else
        return false;
}

function get($url, $timeout = 30)
{
    $ch = curl_init();
    $curl_opt = array(CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_TIMEOUT => $timeout);
    curl_setopt_array($ch, $curl_opt);
    $getcontent = curl_exec($ch);
    curl_close($ch);
    return $getcontent;
}

function orderby($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
{
    if (is_array($arrays)) {
        foreach ($arrays as $array) {
            if (is_array($array)) {
                $key_arrays[] = $array[$sort_key];
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
    array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
    return $arrays;
}


function myTrim($str)
{
    $search = array(" ", "　", "\n", "\r", "\t");
    $replace = array("", "", "", "", "");
    return str_replace($search, $replace, $str);
}

function countline($path)
{
    $fp = fopen($path, "r");
    $i = 0;
    while (!feof($fp)) {
        $text = fgets($fp);
        $i++;
    }
    return $i;
}

function array_coli($array, $key)
{
    if (is_array($array)):
        foreach ($array as $k => $v) {
            // if($v[$key]){
            $data[$k] = $v[$key];
            //}
        }
    endif;
    return $data;
}

function array_diffi($array1, $array2, $key = array())
{
    if (!$key) {
        $key = array_keys($array1);
    }
    foreach ($key as $k) {
        //   dump("$k:".$array1[$k].'|'.$array2[$k].'<br>');
        if (@$array1[$k] != @$array2[$k]) {
            return true;
        }
    }
    return false;
}

function array_filteri($array, $fitter, $diyfiter = null)
{
    foreach ($array as $key => $value) {
        if (in_array($key, $fitter)) {
            $data[$key] = $value;
        }
    }
    if ($diyfiter) {
        $data = array_diyfiter($data, $diyfiter);
    }
    return $data;
}

function untrim($str, $pre)
{
    return $pre . $str . $pre;
}

function array_untrim($array, $pre)
{
    foreach ($array as $key => $value) {
        $array[$key] = untrim($value, $pre);
    }
    return $array;
}

function feed2array($feed, $load = true)
{
    if ($load) {
        if (!$feed_content = file_get_contents($feed)) {
            return false;
        }
    } else {
        $feed_content = $feed;
    }
    $flux = array('infos' => array(), 'items' => array());
    if (preg_match('~<rss(.*)</rss>~si', $feed_content)) {
        $type = 'RSS';
    }//RSS ?
    elseif (preg_match('~<feed(.*)</feed>~si', $feed_content)) {
        $type = 'ATOM';
    }//ATOM ?
    else return false;//if the feed isn't rss or atom
    $feed_content = $feed_content;
    $flux['infos']['type'] = $type;
    try {
        if ($feed_obj = new SimpleXMLElement($feed_content, LIBXML_NOCDATA)) {
            $flux['infos']['version'] = $feed_obj->attributes()->version;
            if (!empty($feed_obj->attributes()->version)) {
                $flux['infos']['version'] = (string)$feed_obj->attributes()->version;
            }
            if (!empty($feed_obj->channel->title)) {
                $flux['infos']['title'] = (string)$feed_obj->channel->title;
            }
            if (!empty($feed_obj->channel->subtitle)) {
                $flux['infos']['subtitle'] = (string)$feed_obj->channel->subtitle;
            }
            if (!empty($feed_obj->channel->link)) {
                $flux['infos']['link'] = (string)$feed_obj->channel->link;
            }
            if (!empty($feed_obj->channel->description)) {
                $flux['infos']['description'] = (string)$feed_obj->channel->description;
            }
            if (!empty($feed_obj->channel->language)) {
                $flux['infos']['language'] = (string)$feed_obj->channel->language;
            }
            if (!empty($feed_obj->channel->copyright)) {
                $flux['infos']['copyright'] = (string)$feed_obj->channel->copyright;
            }

            if (!empty($feed_obj->title)) {
                $flux['infos']['title'] = (string)$feed_obj->title;
            }
            if (!empty($feed_obj->subtitle)) {
                $flux['infos']['subtitle'] = (string)$feed_obj->subtitle;
            }
            if (!empty($feed_obj->link)) {
                $flux['infos']['link'] = (string)$feed_obj->link;
            }
            if (!empty($feed_obj->description)) {
                $flux['infos']['description'] = (string)$feed_obj->description;
            }
            if (!empty($feed_obj->language)) {
                $flux['infos']['language'] = (string)$feed_obj->language;
            }
            if (!empty($feed_obj->copyright)) {
                $flux['infos']['copyright'] = (string)$feed_obj->copyright;
            }

            if (!empty($feed_obj->channel->item)) {
                $items = $feed_obj->channel->item;
            }
            if (!empty($feed_obj->entry)) {
                $items = $feed_obj->entry;
            }
            if (empty($items)) {
                return false;
            }
            //aff($feed_obj);
            foreach ($items as $item) {
                $c = count($flux['items']);
                if (!empty($item->title)) {
                    $flux['items'][$c]['title'] = (string)$item->title;
                }
                if (!empty($item->logo)) {
                    $flux['items'][$c]['titleImage'] = (string)$item->logo;
                }
                if (!empty($item->icon)) {
                    $flux['items'][$c]['icon'] = (string)$item->icon;
                }
                if (!empty($item->subtitle)) {
                    $flux['items'][$c]['description'] = (string)$item->subtitle;
                }
                if (!empty($item->link['href'])) {
                    $flux['items'][$c]['link'] = (string)$item->link['href'];
                }
                if (!empty($item->language)) {
                    $flux['items'][$c]['language'] = (string)$item->language;
                }
                if (!empty($item->author->name)) {
                    $flux['items'][$c]['author'] = (string)$item->author->name;
                }
                if (!empty($item->author->email)) {
                    $flux['items'][$c]['email'] = (string)$item->author->email;
                }
                if (!empty($item->updated)) {
                    $flux['items'][$c]['last'] = (string)$item->updated;
                }
                if (!empty($item->rights)) {
                    $flux['items'][$c]['copyright'] = (string)$item->rights;
                }
                if (!empty($item->generator)) {
                    $flux['items'][$c]['generator'] = (string)$item->generator;
                }
                if (!empty($item->guid)) {
                    $flux['items'][$c]['guid'] = (string)$item->guid;
                }
                if (!empty($item->pubDate)) {
                    $flux['items'][$c]['pubDate'] = (string)$item->pubDate;
                }
                if (!empty($item->description)) {
                    $flux['items'][$c]['description'] = (string)$item->description;
                }
                if (!empty($item->summary)) {
                    $flux['items'][$c]['description'] = (string)$item->summary;
                }
                if (!empty($item->published)) {
                    $flux['items'][$c]['date'] = (string)$item->published;
                }
                if (!empty($item->update)) {
                    $flux['items'][$c]['update'] = (string)$item->update;
                }
                if (!empty($item->content)) {
                    $flux['items'][$c]['description'] = (string)$item->content;
                }
                if (!empty($item->link)) {
                    $flux['items'][$c]['link'] = (string)$item->link;
                }
                // for the tricky <content:encoded> tag
                if (!empty($item->children('content', true)->encoded)) {
                    $flux['items'][$c]['bt_content'] = (string)$item->children('content', true)->encoded;
                }
            }
            return $flux;
        } else return false;
    } catch (Exception $e) {
        echo 'Parse error XML: ' . $feed . ' : ' . $e->getMessage();
        return false;
    }
}

function array_append(&$array, $data)
{
    $array = is_array($array) ? $array : (array)$array;
    array_push($array, $data);
}

//低版本兼容 函数
if (!function_exists('array_column')) {
    function array_column($input, $columnKey, $indexKey = null)
    {
        $columnKeyIsNumber = (is_numeric($columnKey)) ? true : false;
        $indexKeyIsNull = (is_null($indexKey)) ? true : false;
        $indexKeyIsNumber = (is_numeric($indexKey)) ? true : false;
        $result = array();
        foreach ((array)$input as $key => $row) {
            if ($columnKeyIsNumber) {
                $tmp = array_slice($row, $columnKey, 1);
                $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : null;
            } else {
                $tmp = isset($row[$columnKey]) ? $row[$columnKey] : null;
            }
            if (!$indexKeyIsNull) {
                if ($indexKeyIsNumber) {
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && !empty($key)) ? current($key) : null;
                    $key = is_null($key) ? 0 : $key;
                } else {
                    $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }
            $result[$key] = $tmp;
        }
        return $result;
    }
}
if (!function_exists('str_format_repalce')) {
    /**
     * @param $find
     * @param $replace
     * @param $src
     * @param int $search_start
     * 感觉自己像一个智障  这个函数白写了  用不着 先放着  万一用上了呢
     * 功能是查找匹配字符串
     */
    function str_format_repalce($find, $replace, $src, $search_start = 0)
    {
        global $G;
        $i = strlen($src);//长度
        $find_len = strlen($find);
        $find_point = 0;//查找指针
        $tempstr = "";
        $replace_time = substr_count($find, '%');//需要查找不定变量几次
        $replaced_time = 0;//已经替换多少次
        for ($j = $search_start; $j < $i; $j++) {//遍历src
            if ($find[$find_point] != '%') {//固定字符
                if ($src[$j] == $find[$find_point]) {
                    $find_point++;
                    $tempstr .= $src[$j];
                } else {
                    $tempstr = "";
                    $find_point = 0;
                }
            } else {
                if (in_array($src[$j], $G['sec']['format'][$find[$find_point + 1]])) {
                    $tempstr .= $src[$j];
                    if (!in_array($src[$j + 1], $G['sec']['format'][$find[$find_point + 1]])) {
                        $find_point += 2;
                    }
                    //预判是否满足
                    if ($find[$find_point] == '%') {
                        if (!in_array($src[$j + 1], $G['sec']['format'][$find[$find_point + 1]])) {
                            $j--;
                        }
                    } else {
                        if ($src[$j + 1] != $find[$find_point]) {
                            $j--;
                        }
                    }
                } else {
                    $tempstr = "";
                    $find_point = 0;
                }
            }
            if ($find_point >= $find_len && $find_point > 0)
                break;
        }
        $new_src = str_replace($tempstr, $replace, $src);
        if ($new_src != $src) {

        }

    }
}
?>