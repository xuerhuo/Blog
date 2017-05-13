<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>许繁'blog</title>
    <?= import('reset.css') ?>
    <?= import('common.css') ?>
    <?= import('common.js') ?>
    <?= import('jquery-2.1.0.js') ?>
    <script src="<?php echo DATA_LIB ?>editor/editormd.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/marked.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/prettify.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/raphael.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/underscore.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/sequence-diagram.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/flowchart.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/lib/jquery.flowchart.min.js"></script>
    <script src="<?php echo DATA_LIB ?>editor/editormd.js"></script>

    <link rel="stylesheet" href="<?php echo DATA_LIB ?>editor/css/editormd.preview.css"/>
    <?= import('home_article_view.js') ?>
</head>
<body>
<div id="wrap">
    <div id="head">
        <h2><a href="<?= $G['config']['app']['siteurl'] ?>">许繁'blog</a></h2>
        <p>承载我的青春</p>
        <ul class="nav-menu">
            <li><a href="<?= $G['config']['app']['siteurl'] ?>">首页</a></li>
            <li>首页</li>
            <li>首页</li>
            <li>首页</li>
            <li>首页</li>
        </ul>
    </div>
    <div id="content">
        <h3 class="title"><?= $article['title'] ?></h3>
        <div id="article_content">
            <pre id="markdown"><?= $article['content'] ?></pre>
            <pre id="markdown-view"></pre>
            <p class="content_des">本条目发表于<?= date('Y', $article['dateline']) ?>年<?= date('m', $article['dateline']) ?>
                月<?= date('d', $article['dateline']) ?>日。属于<b><?= $article['cat_name'] ?></b>分类</p>
        </div>
        <div class="around-article">
            <? if (!empty($aaroundarticle[0])): ?>
                <a class="pre"
                   href="<?= U('home/article/view', array('aid' => $aaroundarticle[0]['id'])) ?>">←<?= $aaroundarticle[0]['title'] ?></a>
            <? endif; ?>
            <? if (!empty($aaroundarticle[1])): ?>
                <a class="next"
                   href="<?= U('home/article/view', array('aid' => $aaroundarticle[1]['id'])) ?>"><?= $aaroundarticle[1]['title'] ?>
                    →</a>
            <? endif; ?>
        </div>
        <div id="comment">
            <ul class="comment-list">
                <li class="comment-item"></li>
            </ul>
            <form action="<?php echo U('home/article/comment'); ?>" method="post">
                <input type="text" name="coment_name" id="comment_name" placeholder="姓名">
                <input type="hidden" name="id" id="article_id" value="<?php echo $G['get']['param']['aid']; ?>">
                <textarea name="coment_content" id="comment_content" required></textarea>
                <button class="btn" type="submit">提交</button>
            </form>
        </div>
    </div>
    <div id="nav">
        <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=280 height=450
                src="//music.163.com/outchain/player?type=0&id=118004103&auto=0&height=430"></iframe>
    </div>
    <div class="cl"></div>
</div>

</body>
</html>