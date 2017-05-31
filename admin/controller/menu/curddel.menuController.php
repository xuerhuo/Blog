<?php
$settings = M('Cms\admin\setting')->getCurdCellByAlias($G['get']['param']['alias']);
$data = T($settings[0]['data_table'])->delete(array('id' => $G['get']['param']['id']));
if ($data) {
    msg("删除成功", 'admin/menu/curdlist/alias/' . $G['get']['param']['alias']);
} else {
    msg("删除失败", 'admin/menu/curdlist/alias/' . $G['get']['param']['alias']);
}

?>