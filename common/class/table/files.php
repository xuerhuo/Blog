<?php

namespace Cms\common;
class files extends \Cms\core\db
{
    public function init()
    {
        \Cms\core\db::set_table(__CLASS__);
    }

}

?>