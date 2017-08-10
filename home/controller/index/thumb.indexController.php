<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/7/22
 * Time: 10:26
 */
$path = base64_decode($G['get']['param']['path']);
$temp = new \Cms\common\imgcompress($path,0.1);
