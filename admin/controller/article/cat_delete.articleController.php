<?php
if (T('cats')->delete(array('cat_id' => $G['get']['param']['0']))) {
    msg('删除成功', 'admin/article/cat');
} else {
    msg('删除失败', 'admin/article/cat');
}
?>