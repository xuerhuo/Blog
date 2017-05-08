<html>
<head>
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('jquery.min.js') ?>
    <?= import('bootstrap.css') ?>
    <?= import('bootstrap.min.js') ?>
    <?= import('admin_article_index.css') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>文章管理</h3>
        <p>文章管理</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>内容管理</a>><a href="<?= U('admin/article/index') ?>">文章管理</a> <a
                href="<?= U('admin/article/edit') ?>">添加文章</a>
    </nav>
</header>
<ul class="article_list list-group">
    <li CLASS="header">
        <div class="article-id">编号</div>
        <div class="article-author">作者</div>
        <div class="article-title">标题</div>
        <div class="article-content">内容</div>
        <div class="article_cat">分类</div>
        <div class="article_status">文章状态</div>
        <div class="article_dateline">发表时间</div>
        <div class="article_manage">管理</div>
    </li>
    <? foreach ($articles as $article): ?>
        <li class="list-group-item">
            <div class="article-id"><?= $article['id'] ?></div>
            <div class="article-author"><?= $article['author'] ?></div>
            <div class="article-title"><?= $article['title'] ?></div>
            <div class="article-content"><?= $article['content_sumary'] ?></div>
            <div class="article_cat"><?= $article['cat_name'] ?></div>
            <div class="article_status"><?= $article['status'] ?></div>
            <div class="article_dateline"><?= date("Y-m-d H:i:s", $article['dateline']) ?></div>
            <div class="article_manage"><a href="<?= U('admin/article/edit/' . $article['id']); ?>">编辑</a><a
                        href="<?= U('admin/article/delete/' . $article['id']); ?>">删除</a></div>
        </li>
    <? endforeach; ?>
</ul>
</body>
</html>