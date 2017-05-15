<?php

namespace Cms\common;
class Storage implements StorageInterface
{

    public function __construct()
    {
        echo 'hello';
    }

    function upload($srcPath, $dstPath)
    {

    }

    function createFolder($bucket, $folder, $bizAttr = null)
    {
        // TODO: Implement createFolder() method.
    }

    function listFolder($bucket, $folder, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null)
    {
        // TODO: Implement listFolder() method.
    }

    function prefixSearch($bucket, $prefix, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null)
    {
        // TODO: Implement prefixSearch() method.
    }

    function updateFolder()
    {
        // TODO: Implement updateFolder() method.
    }

    function statFolder()
    {
        // TODO: Implement statFolder() method.
    }

    function delFolder()
    {
        // TODO: Implement delFolder() method.
    }

    function update()
    {
        // TODO: Implement update() method.
    }

    function stat()
    {
        // TODO: Implement stat() method.
    }

    function delFile()
    {
        // TODO: Implement delFile() method.
    }

    function uploadFile()
    {
        // TODO: Implement uploadFile() method.
    }
}

?>