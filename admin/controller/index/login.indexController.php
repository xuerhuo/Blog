<?php

namespace Cms\admin;
$C['Admin'] = new Admin();
$G['post'] = array_diyfiter($G['post'], 'sqlinjection');

if ($G['post']) {
    $C['Admin']->adminlogin(addslashes($G['post']['username']), addslashes($G['post']['password']));
}
if ($G['get']['param']['ajax'] == 1) {
    $ret = array();
    if ($G['post']['username'] && $G['post']['password']) {
        if ($C['Admin']->isadmin) {
            $ret['status'] = true;
        } else {
            $ret['status'] = false;
            $ret['data']['msg'] = 'username or password error / you are not administrator';
        }
    } else {
        $ret['status'] = false;
        $ret['data']['msg'] = "no username or passwod data";
    }
    json_output($ret);
}
if ($C['Admin']->isadmin && $G['get']['param']['ajax'] == 0) {
    direct('admin/index/index');
}
?>