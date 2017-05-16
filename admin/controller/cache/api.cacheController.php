<?php
$conf = array(
    'regin' => 'gz',
    'bucket' => 'erhuoorg'
);
if ($G['post']['cache-type'] == 'qcloud') {
    $storage = new \Cms\common\Storage($conf);
    $files = array_merge(scanpath(WEBROOT . 'tpl/') + scanpath(WEBROOT . 'data/'));
    $upfiles;
    foreach ($files as $key => $file) {
        if (get_extension($file) != 'php') {
            array_append($upfiles, $file);
        }
    }
    if ($G['post']['method'] == 'getfile') {
        json_output(array('status' => true, 'data' => $upfiles));
    }
    if ($G['post']['method'] == 'updatefile') {
        $ret = array('status' => false);
        $file = $G['post']['file'];
        if (!file_exists($file) || !in_array($file, $upfiles)) {
            $ret['status'] = false;
            $ret['message'] = "文件不存在";
        } elseif (1) {
            $ret['status'] = false;
            $ret['message'] = "文件" . $file . "更新成功";
        }
        json_output($ret);
    }
}
?>