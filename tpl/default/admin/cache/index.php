<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('common.js') ?>
    <?= import('admin_cache_index.js') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>缓存管理</h3>
        <p>你好</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>主页</a>><a>主页</a>
    </nav>
</header>
<div id="coontent">
    <textarea class="information">

    </textarea>
    <div class="wrap">
        <button class="flush-qcloud">更新腾讯云缓存</button>
    </div>
</div>
</body>
</html>