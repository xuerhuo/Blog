<?php
if ($G['get']['param'][0]) {
    $article = $M->getArticles(array('id' => $G['get']['param'][0]))[0];
}
$cats = $M->getCats();


if ($G['post']) {
    if (!$G['post']['article_id']) {
        if ($M->addArticle($G['post'])) {
            msg('添加成功', 'admin/article/index');
        } else {
            msg('添加失败', 'admin/article/index');
        }
    } else {
        $status = $M->saveArticle($G['post']);
        echo $status;
        $status ? msg('更新成功', 'admin/article/index') : msg('更新失败', 'admin/article/index');
    }
}

?>