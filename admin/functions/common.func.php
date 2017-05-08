<?php
if (!function_exists('getMenuTree')) {
    /*
     * 递归实现 获取菜单列表  结果为树状数组
     * 菜单类型
     * 父id
     */
    function getMenusTree($type, $parent_id = 0, $level = 0, $all = false)
    {
        $top_menus = T('menus')->getMenusByParent($type, $parent_id, $all);
        foreach ($top_menus as $key => $menu) {
            $top_menus[$key]['level'] = $level;
            $top_menus[$key]['sub_menu'] = getMenusTree($type, $menu['id'], $level + 1, $all);
        }
        return $top_menus;
    }
}
if (!function_exists('getMenuTreeL')) {
    /*
     * 递归实现 获取菜单列表  结果为线性数组
     */
    function getMenusTreeL($type, &$data = array(), $trees = array(), $parent_id = 0, $all = false)
    {
        if (!$trees)
            $trees = getMenusTree($type, $parent_id, 0, $all);
        foreach ($trees as $tree) {
            $tmp = $tree;
            unset($tmp['sub_menu']);
            $data[] = $tmp;
            if ($tree['sub_menu'])
                getMenusTreeL($type, $data, $tree['sub_menu'], $all);
        }
        return $data;
    }
}
?>