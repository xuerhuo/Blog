<?php
//$C['cache']->set('SELECT * FROM pre_common_setting where menu_alias=\'common','testvalue',60*60*5);
dump($C['cache']->get('SELECT * FROM pre_common_setting where menu_alias=\'common'));
dump(sha1('SELECT * FROM pre_common_setting where menu_alias=\'common'));
?>