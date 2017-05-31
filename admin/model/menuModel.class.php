<?php

namespace Cms\admin;
class menuModel extends \Cms\core\Model
{
    function getMenuByType($type)
    {

        function getMenusTree($type, $parent_id = 0, $level = 0, $all = false)
        {
            $top_menus = T('menus')->getMenusByParent($type, $parent_id, $all);
            foreach ($top_menus as $key => $menu) {
                $top_menus[$key]['level'] = $level;
                $top_menus[$key]['sub_menu'] = getMenusTree($type, $menu['id'], $level + 1, $all);
            }
            return $top_menus;
        }
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

        $data = getMenusTreeL('all');
        foreach ($data as $dat) {
            if ($dat['type'] == $type) {
                $res[] = $dat;
            }
        }
        // unset($res[0]);
        return $res;
    }

    public function getMenuName($arr = null, &$ret = array())
    {
        global $G;
        if ($arr == null) {
            $now_menu = T('menus')->find(array(
                'menu_mod' => implode('/', array($G['get']['d'], $G['get']['f'], $G['get']['m']))
            ));
        } else {
            $now_menu = T('menus')->find($arr);
        }
        if ($now_menu) {
            array_append($ret, $now_menu);
            if ($now_menu['parent_id'] > 0) {
                $this->getMenuName(array('id' => $now_menu['parent_id']), $ret);
            } else {

                // return $now_menu;
            }
        }

        return $ret;
    }
}

?>