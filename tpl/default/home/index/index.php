<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $G['config']['common']['site_title'] ?></title>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?= import('reset.css') ?>
    <?= import('common.css') ?>
    <?= import('home_index_index.css') ?>
</head>
<body>
<div id="wrap">
    <div id="head">
        <h2><a href="<?= $G['config']['app']['siteurl'] ?>"><?php echo $G['config']['common']['site_title'] ?></a></h2>
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
        <ul class="article_list">
            <?php foreach ($lists as $list): ?>
                <li>
                    <h3 class="title"><a
                                href="<?= U('home/article/view', array('aid' => $list['id'])) ?>"> <?= $list['title'] ?></a>
                    </h3>
                    <p class="article_content">
                        <?= $list['content_sumary'] ?>
                    </p>
                    <a href="<?= U('home/article/view', array('aid' => $list['id'])) ?>" class="read_all">阅读全文</a>
                    <p class="article_des">本文章发布于<?= date('Y', $list['dateline']); ?>
                        年<?= date('m', $list['dateline']); ?>月<?= date('d', $list['dateline']); ?>日 分类:未分类</p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="nav">
        <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=280 height=450
                src="//music.163.com/outchain/player?type=0&id=118004103&auto=0&height=430"></iframe>
        <span style="text-decoration: underline;"><span style="color: #333333; text-decoration: underline;"><strong><a
                            style="color: #333333; text-decoration: underline;"
                            href="http://www.jermey.cn/">四少爷’blog</a></strong></span></span> <strong><a
                    style="color: #333333; text-decoration: underline;" href="http://yige.org">一个’blog</a> </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.jurieo.com">俊霖’blog</a>
        </strong> <strong><a style="color: #333333; text-decoration: underline;"
                             href="http://www.yangbin.cc">杨彬’blog</a> </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://dongdong.name/">东东博客</a> </strong>
        </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.w0ai1uo.org">w0ai1ou'blog</a>
        </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.hailairen.com">hailairen</a>
        </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.sakill.com">流沙的博客</a> </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.inzhuo.cn/">卓的云</a></strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://speach.cc/blog/">商院之声</a></strong>
    </div>
    <div class="cl"></div>
</div>

</body>
</html>