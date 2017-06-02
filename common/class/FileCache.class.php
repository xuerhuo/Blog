<?php

namespace Cms\common;
class FileCache
{
    public $cachefiledir;

    public function __construct()
    {
        $this->cachefiledir = WEBROOT . 'data' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'keyvalue' . DIRECTORY_SEPARATOR;
    }

    public function set($key, $value, $exp = null)
    {
        global $G;
        if ($G['config']['app']['cache_enable'] != true) {
            return false;
        }
        if ($exp === null) {
            $exp = $G['config']['app']['file_cache_expire'];
        }
        $oldkey = $key;
        $key = sha1($key);
        $data = array(
            'exp' => $exp,
            'key' => $oldkey,
            'createtime' => time(),
            'data' => $value
        );
        $data = json_encode($data);
        file_put_contents($this->cachefiledir . $key, $data);
        return true;
    }

    public function get($key)
    {
        global $G;
        if ($G['config']['app']['cache_enable'] != true) {
            return false;
        }

        $key = sha1($key);

        $file = $this->cachefiledir . $key;
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), 1);
            if ($data['exp'] == 0) {
                return $data['data'];
            } elseif (time() - $data['createtime'] <= $data['exp']) {
                return $data['data'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function clear($del_all = false)
    {
        $ret = array();
        $files = scanpath($this->cachefiledir);
        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), 1);
            if ($data['exp'] != 0 || $del_all) {
                if (unlink($file))
                    $ret['message'] .= "delete $file\r\n";
            }
        }
        $ret['status'] = true;
        return $ret;
    }
}