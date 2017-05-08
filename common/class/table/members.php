<?php

namespace Cms\common;
class members extends \Cms\core\db
{
    public function getuser($username)
    {
        return \Cms\core\db::find(array('username' => $username));
    }

    public function getuserbyuid($uid)
    {
        return \Cms\core\db::find(array('id' => $uid));
    }
}

?>