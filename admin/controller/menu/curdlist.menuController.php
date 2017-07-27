<?php
//$G['get']['param'];
$settings = M('Cms\admin\setting')->getCurdCellByAlias($G['get']['param']['alias'], 1);
$data = T($settings[0]['data_table'])->select();
?>