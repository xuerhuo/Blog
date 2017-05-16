<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/5/15
 * Time: 20:45
 */

namespace Cms\common;
interface StorageInterface
{
    // function __construct($args);

    function upload($srcPath, $dstPath);

    function createFolder($bucket, $folder, $bizAttr = null);

    function listFolder($bucket, $folder, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null);

    function prefixSearch($bucket, $prefix, $num = 20, $pattern = 'eListBoth', $order = 0, $context = null);

    function updateFolder();

    function statFolder();

    function delFolder();

    function update();

    function stat();

    function delFile();

    function uploadFile();
}

?>