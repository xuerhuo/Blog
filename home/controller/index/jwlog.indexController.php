<?php
db::set_table("jwlog");
$status = db::add(array(
    'sn' => $G['get']['param'][0],
    'decode' => $G['get']['param'][1],
    'status' => $G['get']['param'][2],
));
if ($status) {
    echo 'ok';
} else {
    echo 'error';
}
?>