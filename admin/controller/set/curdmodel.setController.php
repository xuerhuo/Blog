<?php
/**
 * Created by PhpStorm.
 * User: erhuo.org
 * Date: 2017/3/14
 * Time: 15:46
 */
$setting = T('common_setting')->select();
if (!empty($G['post']) && $G['get']['param']['ajax']) {
    json_output(array(
        'status' => T('common_menu')->add(array_filteri($G['post'], array('tpl', 'common_setid', 'alias'))),
    ));
}
?>