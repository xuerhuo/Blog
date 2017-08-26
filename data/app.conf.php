<?php
$config['tpl'] = ROOT . 'tpl' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR;
$config['croncalltime'] = 60;
$config['siteurl'] = 'http://erhuo.org/';
$config['debug'] = false;
$config['allow_upload_type'] = array('jpg', 'jpeg', 'gif', 'bmp', 'psd', 'png',
    'apk', 'rar', 'css', 'txt', 'gz',
    'tar','pdf','exe','zip','exe','msi','dll',
    'doc','doct','docx','ppt','pptx','xls','xlsx');
$config['error_level'] = 0;
$config['cache_enable'] = true;
$config['file_cache_expire'] = 60 * 30;
$config['tpl_cache_path'] = ROOT . 'data' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'tpl' . DIRECTORY_SEPARATOR;
$config['static_url'] = true;//是否开启url html后缀
$config['static_url_suffix'] = '.html';//开启url 后的url后缀
$config['qcloud_cos_config'] = array('regin' => 'gz', 'bucket' => 'erhuoorg');
?>