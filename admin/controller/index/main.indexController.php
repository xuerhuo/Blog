<?php
//$C['cache']->set('SELECT * FROM pre_common_setting where menu_alias=\'common','testvalue',60*60*5);
$C['tpl'] = new \Cms\core\Template(TPL . 'home/index/index2.php');
dump($C['tpl']->tpl_content);
?>