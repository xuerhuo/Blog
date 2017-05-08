<?php
$cats = $M->getCats();
if ($G['post']) {
    if ($G['post']['cat_id']) {
        if ($M->updateCat($G['post'])) {
            msg('修改成功', 'admin/article/cat');
        } else {
            msg('修改失败', 'admin/article/cat');
        }
    } else {
        if ($M->addCat($G['post'])) {
            msg('添加成功', 'admin/article/cat');
        } else {
            msg('添加失败', 'admin/article/cat');
        }
    }
}
?>