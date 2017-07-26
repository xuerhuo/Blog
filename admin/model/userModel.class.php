<?php

namespace Cms\admin;
class userModel extends \Cms\core\Model
{
    public function getGroup()
    {
        $groups = T('group')->select();
        foreach ($groups as $key => $group) {
            $groups[$key]['count'] = count(T('group_user')->select(array('group_id' => $group['id'])));
        }
        return $groups;
    }

    public function getUsers()
    {
        $sql = \Cms\core\db::format("SELECT m.*,g.* FROM %t as m
LEFT JOIN %t as relation on m.id=relation.uid
LEFT JOIN %t as g on relation.group_id=g.id", array(
            'members', 'group_user', 'group'
        ));
        return \Cms\core\db::fetchall($sql);
    }
}