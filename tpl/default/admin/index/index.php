<html>
<head>
    <meta charset="utf-8">
    <title>管理面板 你好,<?= $C['Admin']->nickname ?></title>
    <?= import('bootstrap.css') ?>
    <?= import('jquery-2.1.0.js') ?>
    <?= import('bootstrap.min.js') ?>
    <?= import('reset.css') ?>
    <?= import('admin_index.css') ?>

    <?= import('admin_index.js') ?>
</head>
<body class="full">
<div class="header">
    <ul>
        <li class="pull-right">
            <div class="">
                <p>hello <?= $C['Admin']->nickname ?></p>
                <a href="<?= U('admin/index/logout') ?>" class="">退出</a>
        </li>
    </ul>
</div>
<div class="menu">
    <ul class="menuf">
        <?php foreach ($menus as $menu): ?>
            <li>
                <div><span class="glyphicon <?= $menu['icon'] ?>"></span><?= $menu['menu_name'] ?><span
                            class="glyphicon icon glyphicon-chevron-left"></span></div>
                <?php foreach ($menu['sub_menu'] as $menusec): ?>
                    <ul class="menus">
                        <li><a href="<?= U($menusec['menu_mod']) ?>"><?= $menusec['menu_name'] ?></a></li>
                    </ul>
                <?php endforeach; ?>
            </li>

        <?php endforeach; ?>
    </ul>
</div>
<section>
    <iframe id="windows" border="1" width="100%" height="100%" src="<?= U('admin/index/main') ?>"></iframe>
</section>
</body>
</html>