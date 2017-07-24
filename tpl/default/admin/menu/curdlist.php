<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('admin_menu_curdlist.css') ?>
    <?= import('jquery-2.1.0.js') ?>
    <?= import('common.js') ?>
    <?= import('admin_menu_curdlist.js') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>分类管理</h3>
        <p>分类管理</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>内容管理</a>><a href="<?= U('admin/article/index') ?>">分类管理</a><a
                href="<?= U('admin/menu/curdedit', array('alias' => $G['get']['param']['alias'])) ?>">添加数据</a>
    </nav>
</header>
<div class="wrap">
    <div class="topimg"><img src=""/></div>
    <div class="post_box">
        <div class="title"><h2><span class="glyphicon  glyphicon-pencil"></span>管理</h2></div>
        <table class="admin_menu_ul">
            <thead>
            <td> ID</td>
            <?php foreach ($settings as $set): ?>
                <td>
                    <?php echo $set['set_name'] ?>
                </td>
            <?php endforeach; ?>
            <td> 操作</td>
            </thead>


            <?php foreach ($data as $dat): ?>
                <tbody>
                <td><?php echo $dat['id'] ?> </td>
                <?php foreach ($settings as $set): ?>
                    <td>
                        <?php //echo $dat[$set['field']]?>
                        <?php if ($set['option_type'] == 'file'): ?>
                            <img class="showimg" src="
                    <?php echo DATA_FILE . $dat[$set['field']] ?>"/>
                        <?php elseif ($set['option_type'] == 'time'): ?>
                            <?php echo date('Y-m-d H:i', $dat[$set['field']]) ?>
                        <?php elseif ($set['option_type'] == 'img'): ?>
                            <img class="showimg" src="
                        <?php echo DATA_FILE . $dat[$set['field']] ?>"/>
                        <?php elseif ($set['option_type'] == 'text' || $set['option_type'] == 'fulltext'): ?>
                            <?php echo mb_substr(strip_tags($dat[$set['field']]), 0, 18, 'UTF-8') ?>
                        <?php elseif ($set['option_type'] == 'select'): ?>
                            <?php
                            $json = json_decode($set['value'], 1);
                            $json['index_field'] = $json['index_field'] ? $json['index_field'] : 'id';
                            $out = $json['table'] . '.' . $json['index_field'] . '.' . $json['field'];
                            ?>
                            <?php echo function_output($out, $dat[$set['field']]) ?>
                        <?php else: ?>
                            <?php echo function_output($set['option_type'], $dat[$set['field']]); ?><!--如果不知道类型，传给函数处理-->
                        <?php endif; ?>
                    </td>
                <?php endforeach; ?>
                <td><a href="<?php echo U('admin/menu/curdedit', array(
                        'alias' => $G['get']['param']['alias'],
                        'id' => $dat['id'])) ?>">编辑</a><a href="<?php echo U('admin/menu/curddel', array(
                        'alias' => $G['get']['param']['alias'],
                        'id' => $dat['id'])) ?>">删除</a></td>
                </tbody>
            <?php endforeach; ?>


        </table>
    </div>
</div>
</body>
</html>