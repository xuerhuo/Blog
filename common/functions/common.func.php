<?php
//if(!function_exists('getMenuTree')){
//    /*
//     * 递归实现 获取菜单列表  结果为树状数组
//     * 菜单类型
//     * 父id
//     */
//    function getMenusTree($type,$parent_id=0,$level=0,$all=false){
//        $top_menus=T('menus')->getMenusByParent($type,$parent_id,$all);
//        foreach ($top_menus as $key=>$menu){
//            $top_menus[$key]['level']=$level;
//            $top_menus[$key]['sub_menu']=getMenusTree($type, $menu['id'],$level+1,$all);
//        }
//        return $top_menus;
//    }
//}
//if(!function_exists('getMenuTreeL')){
//    /*
//     * 递归实现 获取菜单列表  结果为线性数组
//     */
//    function getMenusTreeL($type,&$data=array(),$trees=array(),$parent_id=0,$all=false){
//        if(!$trees)
//            $trees=getMenusTree($type,$parent_id,0,$all);
//        foreach($trees as $tree){
//            $tmp=$tree;
//            unset($tmp['sub_menu']);
//            $data[]=$tmp;
//            if($tree['sub_menu'])
//                getMenusTreeL($type,$data,$tree['sub_menu'],$all);
//        }
//        return $data;
//    }
//}
if (!function_exists('function_output')) {
    function function_output($type, $data)
    {
        switch ($type) {
            case 'html':
                $result = mb_substr(strip_tags($data), 0, 50);
                break;
            case 'select':
                break;
            case 'uid':
                $result = 'uid' . $data;
                break;
            default:
                $result = 'error type :' . $type;
        }
        if (strpos($type, '.') > 0) {
            $ret = explode('.', $type);
            $res = T($ret[0])->find(array($ret[1] => $data));
            $result = $res[$ret[2]];
        }
        return $result;
    }
}
if (!function_exists('get_table_value')) {
    function get_table_value($table, $field, $value)
    {
        return M($table)->where(array($field => $value))->find();

    }
}
if (!function_exists('get_common_setting')) {
    function get_common_setting($set_guid)
    {
        $result = get_table_value('common_setting', 'set_guid', $set_guid);
        return $result['value'];

    }
}
?>