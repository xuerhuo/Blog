<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/7/24
 * Time: 17:52
 */

namespace Cms\common;


use Cms\core\db;

class Auth
{
    public static function check($rule,$uid = ''){
        if(empty($uid)) {
            $uid = self::getUid();
        }
        $mygroup = array_column(self::getGroupByUid($uid),'group_id');
        $accessgroup = array_column(self::getGroupByRule($rule),'group_id');
        foreach ($mygroup as $dat){
            if(in_array($dat,$accessgroup)){
                return true;
            }
        }
        return false;
    }
    public function getUid(){
        $result = $_SESSION['uid'];
        return $result;
    }
    public static function getGroupByUid($uid){
        $data = T('group_user')->select(array('uid'=>$uid));
        return $data;
    }
    public static function getGroupByRule($rule){
        $role_froup=db::table('role_group');
        $__ROLE_RULE__= db::table('role_rule');
        $__RULE__=db::table('rule');
        $sql = "select group_id FROM  $role_froup where role_id in(select role_id from $__ROLE_RULE__ where rule_id in (select id from $__RULE__ where rule_name='{$rule}'))";
        $model = db::query($sql);
        return $model;
    }
}