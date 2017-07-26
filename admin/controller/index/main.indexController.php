<?php
//$C['cache']->set('SELECT * FROM pre_common_setting where menu_alias=\'common','testvalue',60*60*5);
dump(\Cms\common\Auth::check('admin_login'));
dump($_SESSION);
dump($G['config']['common']['basehref']);
?>