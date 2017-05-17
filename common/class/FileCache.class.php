<?php

namespace Cms\common;
class FileCache
{
    public $cachefiledir;

    public function __construct()
    {
        $this->cachefiledir = WEBROOT . 'data' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
    }

    public function set($key, $value, $exp)
    {

    }
}