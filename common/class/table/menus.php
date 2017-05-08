<?php

namespace Cms\common;
class menus extends \Cms\core\db
{
    public static function menuAdd($data)
    {
        return \Cms\core\db::add($data);
    }

    public static function menuSave($index, $data)
    {
        return \Cms\core\db::update($index, $data);
    }

    public function init()
    {
        db::set_table(__CLASS__);
    }

    public function getMenusByParent($type, $parent_id, $all = false)
    {
        if ($type != 'all') {
            $where = array(
                'type' => $type,
                'parent_id' => $parent_id,
                'hide' => 0
            );
        } else {
            $where = array(
                'parent_id' => $parent_id,
                'hide' => 0
            );
        }
        if ($all) {
            unset($where['hide']);
        }
        return \Cms\core\db::select($where);
    }
}

?>