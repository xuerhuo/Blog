<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('bootstrap.css') ?>
    <?= import('admin_article_edit.css') ?>
    <link rel="stylesheet" href="<?= DATA_LIB ?>editor/css/editormd.css"/>
    <?= import('jquery.min.js') ?>
    <?= import('bootstrap.min.js') ?>
    <script src="<?= DATA_LIB ?>editor/editormd.js"></script>
    <?= import('admin_article_edit.js'); ?>
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
<div class="article_item">
    <form action="" method="post">
        <div class="title">
            <label for="title">标题</label>
            <input type="text" name="title" id="title" value="<?= $article['title'] ?>">
            <? if ($G['get']['param'][0]): ?>
                <input type="hidden" name="article_id" value="<?= $G['get']['param'][0] ?>">
            <? endif; ?>
        </div>
        <br>
        <div class="content">
            <label for="content">内容</label>
            <div id="content">
                <textarea name="content" style="display: none"><?= $article['content'] ?></textarea>
            </div>
        </div>
        <br>
        <div class="cat">
            <label for="cat">分类</label>
            <select name="cat">
                <option value="<?= $article['cat'] ?>" selected><?= $article['cat_name'] ?></option>
                <? foreach ($cats as $cat): ?>
                    <option value="<?= $cat['cat_id'] ?>"
                            <? if ($article['cat'] == $cat['cat_id']): ?>selected<? endif; ?>><?= $cat['cat_name'] ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <br>
        <div class="status">
            <label for="status">状态</label>
            <select name="status">
                <option value="1">发布</option>
                <option value="0">不发布</option>
            </select>
        </div>
        <br>
        <div class="tags">
            <label for="tags">标签</label>
            <input type="text" name="tags" value="<?= $article['tags'] ?>">
        </div>
        <div>
            <input type="submit" value="sub">
        </div>
    </form>
</div>
<script>
    var testEditor;
    $(function () {
        testEditor = editormd("content", {
            width: "80%",
            height: "400px",
            syncScrolling: "single",
            path: "<?=DATA_LIB?>editor/lib/"
        })
    });
</script>
</body>
</html>