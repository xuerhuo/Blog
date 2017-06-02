<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/6/1
 * Time: 17:45
 */
$config['%n'] = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
$config['%a'] = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
$config['%A'] = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$config['%l'] = array_merge($config['%a'], $config['%A']);//字母
$config['%s'] = array_merge($config['%l'], $config['%n']);//字符
$config['%v'] = array_merge($config['%s'], array('_'));