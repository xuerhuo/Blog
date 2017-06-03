<?php
$conf = array(
    'regin' => 'gz',
    'bucket' => 'erhuoorg'
);
$G['config']['app']['cache_enable'] = true;
if ($G['post']['cache-type'] == 'qcloud') {
    $storage = new \Cms\common\Storage($conf);
    array_append($files, scanpath(WEBROOT . 'tpl/'));
    array_append($files, scanpath(WEBROOT . 'data/lib/'));
    array_append($files, scanpath(WEBROOT . 'data/file/'));
    // $files = array_merge(scanpath(WEBROOT . 'tpl/') + scanpath(WEBROOT . 'data/'));
    $upfiles;
    foreach ($files as $key => $file) {
        if (get_extension($file) != 'php') {
            array_append($upfiles, $file);
        }
    }
    $upfiles = check_cache_file($upfiles);
    if ($G['post']['method'] == 'getfile') {
        json_output(array('status' => true, 'data' => $upfiles));
    }
    if ($G['post']['method'] == 'updatefile') {
        $cache_hash = $C['cache']->get('file_cache_hash');

        $ret = array('status' => false);
        $file = $G['post']['file'];
        $file_hash = sha1_file($file);
        $stat = $storage->stat($file);
        $ret['path'] = $file;
        if (!file_exists($file) || !in_array($file, $upfiles)) {
            $ret['status'] = false;
            $ret['message'] = "文件不存在";
        } elseif ($stat['code'] == -197) {
            $temp = $storage->upload($file);
            if ($temp['code'] == 0) {
                $ret['status'] = true;
                $ret['message'] = '文件' . $file . '上传成功';
                $cache_hash[$file] = $file_hash;//更新本地文件hash缓存
            } else {
                $ret['status'] = true;
                $ret['message'] = '文件' . $file . '上传失败';
                $ret['data'] = $temp;
            }
        } elseif ($stat['code'] == 0) {//qcloud有文件
            $ret['status'] = true;
            if ($stat['data']['sha'] != $file_hash) {
                $storage->delFile($file);
                $temp = $storage->upload($file);
                if ($temp['code'] == 0) {
                    $ret['message'] = '文件' . $file . '更新成功';
                    $cache_hash[$file] = $file_hash;//更新本地文件hash缓存
                }
            } else {
                $ret['message'] = '文件' . $file . '未更新';
                if (!$cache_hash[$file]) {
                    $cache_hash[$file] = $file_hash;//更新本地文件hash缓存
                }
            }
        }
        json_output($ret);
        $C['cache']->set('file_cache_hash', $cache_hash, 0);
    }
} elseif ($G['post']['cache-type'] == "keyvalue") {
    $delall = false;
    if ($G['post']['delall'] == "1") {
        $delall = true;
    }
    json_output($C['cache']->clear($delall));
} elseif ($G['post']['cache-type'] == "template") {
    $C['Template'] = new \Cms\core\Template();
    json_output($C['Template']->clear());
}
if ($G['get']['param']['debug']) {
    array_append($files, scanpath(WEBROOT . 'tpl/'));
    array_append($files, scanpath(WEBROOT . 'data/lib/'));
    array_append($files, scanpath(WEBROOT . 'data/file/'));
    dump($files);
}
?>