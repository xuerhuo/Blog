<?php

namespace Cms\common;
class User
{
    public $uid;
    public $sex;
    public $session;
    public $nickname;
    public $user;
    public $sid;

    //   public $adminid;
    public function __construct()
    {
        $this->session = $_SESSION;
        $this->uid = $this->session['uid'];
        $this->user = T('members')->getuserbyuid($this->uid);
        $this->nickname = $this->user['nickname'];
    }

    public function login($username, $pass)
    {
        $pass = sha1(md5($pass));
        $user = members::getuser($username);
        if ($user['password'] == $pass) {
            $this->uid = $user['id'];
            $_SESSION['uid'] = $this->uid;
            $this->user = $user;
        } else {

        }
    }

    public function loginbyopenid($openid)
    {
        $statud = $this->user = T('members')->find(array('openid' => $openid));
        if ($statud) {
            return $this->loginByUid($this->user['id']);
        }
    }

    public function loginByUid($uid)
    {
        $this->uid = $uid;
        $_SESSION['uid'] = $this->uid;
        $this->user = T('members')->find(array('id' => $this->uid));
        $this->generateSid();
    }

    private function generateSid()
    {
        $sid = sha1(uniqid());
        T('members')->update(array('id' => $this->uid), array('sid' => $sid));
        $this->sid = $sid;
    }
    public function modifypass($oldpassword, $newpassword)
    {
        $ret = array(
            'status' => false,
        );
        if ($this->user['password'] == sha1(md5($oldpassword))) {
            $ret['status'] = T('members')->update(array(
                'id' => $this->user['id']
            ), array(
                'password' => sha1(md5($newpassword))
            ));
        }
        return $ret;
    }

    public function register($userinfo)
    {
        $data['username'] = $userinfo['username'];
        $data['nickname'] = $userinfo['nickname'];
        $data['password'] = $userinfo['password'];
        $data['adminid'] = $userinfo['adminid'];
        $data['groupid'] = $userinfo['groupid'];
        $data['loginip'] = $userinfo['loginip'];
        $data['openid'] = $userinfo['openid'];
        return T('members')->add($data);
    }
}

?>