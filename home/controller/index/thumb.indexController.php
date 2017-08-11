<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/7/22
 * Time: 10:26
 */
$path = ROOT.base64_decode($G['get']['param']['path']);
$per = $G['get']['param']['percent'];
$per = $per ? $per : 0.5;
$temp = new \Cms\common\imgcompress($path,$per);
