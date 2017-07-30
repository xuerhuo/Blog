<?php
//$G['get']['param'];
//$settings = M('Cms\admin\setting')->getCurdCellByAlias($G['get']['param']['alias'],1);
$settings = curd_data_fiter($G['get']['param']['alias']);
$data = T($settings[0]['data_table'])->select();
?>