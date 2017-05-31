<?php
$vps = new \Cms\common\Kiwivm($G['config']['common']['kiwivm_appid'], $G['config']['common']['kiwivm_appsecret'], $G['config']['common']['kiwivm_site']);
$ret = $vps->restart();
if ($ret->error == 0) {
    msg("重启成功", 'home/index/index');
}
$notemplate = 1;
?>