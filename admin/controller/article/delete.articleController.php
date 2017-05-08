<?php
if ($M->delArticle($G['get']['param']['0'])) {
    msg('删除成功', 'admin/article/index');
} else {
    msg('删除失败', 'admin/article/index');
}
?>