<?php

namespace Cms\common;
class FileCache
{
    public $cachefiledir;

    public function __construct()
    {
        $this->cachefiledir = WEBROOT . 'data' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
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
        if ($key == "d0e86de551f673b3298e8b420d8ffacf47eefb4f") {
            $data = json_decode(file_get_contents($file), 1);
            dump($data);
            dump(time() - $data['createtime']);
        }
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
}