<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/2/17
 * Time: 12:36
 */

if (isset($G['get']['param']['method']) && $G['get']['param']['method'] == 'addsetting') {
    if ($G['post']) {
        $data = array_filteri($G['post'], array('set_name', 'option_type', 'menu_alias', 'set_guid', 'tips', 'data_table', 'field'));
        json_output(array(
            'status' => T('common_setting')->add($data)
        ));
    }
}
$setting = T('common_setting')->select(array('menu_alias' => 'common'));


if (!empty($G['post']) && !$G['get']['param']['method'] == 'addsetting') {

    $up = new \Cms\common\Upload();
    $result = $up->upfiles();
    foreach ((array)$result as $key => $res) {
        $G['post'][$key] = $res['path'];
    }
    foreach ((array)$setting as $set) {
        if ($set['option_type'] == 'file') {
            if (empty($G['post'][$set['set_guid']])) {
                $G['post'][$set['set_guid']] = $set['value'];
            }
        }
    }


    $data = array_filteri($G['post'], array_column($setting, 'set_guid'));
    foreach ((array)$data as $key => $dat) {
        T('common_setting')->update(
            array('set_guid' => $key),
            array('value' => $dat)
        );
    }
    msg("修改成功", 'admin/set/setting');
}