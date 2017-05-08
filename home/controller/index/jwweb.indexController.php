<?php
//exit('false');
db::set_table("jwlog");
$data = db::query("SELECT DISTINCT sn FROM `pre_jwlog` ORDER by sn");
foreach ($data as $v) {
    $arr[] = $v['sn'];
}
echo implode($arr, '-');
// db::add(array(
//     'start'=>$end,
//     'end'=>$start+$autocreat,
//     'ip'=>$_SERVER['REMOTE_ADDR'],
// ));

if ($G['get']['param'][0] > 0) {
    db::update(array('end' => $G['get']['param'][0]), array('status' => 'true'));
}
?>