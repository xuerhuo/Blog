<?php

namespace Cms\admin;
include ROOT . $G['get']['d'] . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'common.func.php';
$C['Admin'] = new Admin();
if ($G['get']['m'] != 'login')
    $C['Admin']->checkadmin();
$G['config']['app']['cache_enable'] = false;
?>