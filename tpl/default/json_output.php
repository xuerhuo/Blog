<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/2/21
 * Time: 15:55
 */
if ($G['system']['json_output_type'] == 'json') {
    echo json_encode($G['system']['json_output']);
} elseif ($G['system']['json_output_type'] == 'text') {
    header("Content-type: text/plain;charset=utf-8");
    echo $G['system']['json_output'];
}