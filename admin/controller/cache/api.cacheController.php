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
        json_output(array('status' => true, 'data' => array($upfiles)));
    }

}
?>