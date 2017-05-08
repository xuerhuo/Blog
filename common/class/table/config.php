<?php

namespace Cms\common;
class config
{
    public static function get_cron()
    {
        return db::find(array('name' => 'sys_cron'));
    }

    public static function update_cron($arr)
    {
        return db::update(array('name' => 'sys_cron'), $arr);
    }

    public function init()
    {
        db::set_table('config');
    }

    public function test()
    {
        $ad = 1;
    }
}

?>