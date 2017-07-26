<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/4/9
 * Time: 15:23
 */

if ($G['post']) {
    if ($G['post']['id'] == 0) {
        $status = T('group')->add(array_filteri($G['post'], array('group_name')));
        if ($status) {
            msg('添加成功', 'admin/user/group');
        }
    } else {
        $status = T('group')->update(array_filteri($G['post'], 'id'), array_filteri($G['post'], array('group_name')));
        if ($status) {
            msg('修改成功', 'admin/user/group');
        }
    }
}
if ($G['get']['param']['delete']) {
    $status = T('group_user')->find(array('group_id' => $G['get']['param']['delete']));
    if ($status) {
        msg('用户组中还有用户,请先转移用户', 'admin/user/group');
    } else {
        $status = T('group')->delete(array('id' => $G['get']['param']['delete']));
        if ($status) {
            msg('删除成功', 'admin/user/group', '', true);
        } else {
            msg('删除失败', 'admin/user/group', '', true);

        }
    }
}

$menu = M('\Cms\admin\menu')->getMenuName();
$groups = M('\Cms\admin\user')->getGroup();
?>