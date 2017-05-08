<?php

namespace Cms\admin;
class Admin extends \Cms\common\User
{
    //  public $uid;
    public $isadmin = false;
    public $adminid;

    public function __construct()
    {
        parent::__construct();
        if ($this->user['adminid'] > 0) {
            $this->adminid = $this->user['adminuid'];
            $this->isadmin = true;
        }
        // $this->checkAdmin();
    }

    public function adminlogin($user, $pass)
    {
        $this->login($user, $pass);
        if ($this->user['adminid'] > 0) {
            $this->isadmin = true;
        }
    }

    public function checkAdmin()
    {
        if (!$this->isadmin) {
            direct('admin/index/login');
        }
    }
}

?>