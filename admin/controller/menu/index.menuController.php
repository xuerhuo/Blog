<?php
error_reporting(7);
//$menus=getMenusTreeL('admin_panel',$nullvar,array(),0,true);
$menus = getMenusTreeL('all', $nullvar, array(), 0, true);
if ($G['post']) {
    //更新菜单
    $compare_key = array(
        'parent_id',
        'menu_name',
        'menu_mod',
        'hide',
        'sequence',
        'type'
    );
    foreach ($menus as $menu) {
        $post_menu = array_filteri(array_coli($G['post'], $menu['id']), $compare_key);
        if (array_diffi($post_menu, $menu, $compare_key)) {
            if (T('menus')->menuSave(array('id' => $menu['id']), array_filteri($post_menu, $compare_key)))
                msg('success', 'admin/menu/index');
        }
    }

    //新增菜单
    if ($G['post']['nmenu_name']) {
        $data = array(
            'parent_id' => $G['post']['nparent_id'],
            'menu_name' => $G['post']['nmenu_name'],
            'menu_mod' => $G['post']['nmenu_mod'],
            'hide' => $G['post']['nhide'],
            'sequence' => $G['post']['nsequence'],
            'type' => $G['post']['ntype'],
        );
        $status = T('menus')->menuAdd($data);
        if ($status) {
            dump($status);
            msg('success', 'admin/menu/index');
        } else {
            dump($status);
        }
    }
}
?>