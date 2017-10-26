<?php

namespace Cms\core;
class Model
{
    public function __construct()
    {
        // dump(db::query('select * from tencent'));
    }
    public function select($sql){
        return db::fetchall($sql);
    }
    public function find($sql){
        return db::fetchfirst($sql);
    }
    public function exec($sql){
        return db::exec($sql);
    }
}

?>