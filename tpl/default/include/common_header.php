<?php

add_tpl_static($G['get']['d'] . '_' . $G['get']['f'] . '_' . $G['get']['m'] . '.css');
add_tpl_static($G['get']['d'] . '_' . $G['get']['f'] . '_' . $G['get']['m'] . '.js');
$index_menu = M('\Cms\admin\menu')->getMenuByType('index_menu');
?>
<!--
八戒 你又在看为师的源码了
   ┏┓　　　┏┓
   ┏┛┻━━━┛┻┓
   ┃　　　　　　　┃ 　
   ┃　　　━　　　┃
   ┃　┳┛　┗┳　┃
   ┃　　　　　　　┃
   ┃　　　┻　　　┃
   ┃　　　　　　　┃
   ┗━┓　　　┏━┛
       ┃　　　┃ 神兽保佑　　　　　　　　
       ┃　　　┃ 代码无BUG！
       ┃　　　┗━━━┓
       ┃　　　　　　　┣┓
       ┃　　　　　　　┏┛
       ┗┓┓┏━┳┓┏┛
         ┃┫┫　┃┫┫
         ┗┻┛　┗┻┛
-->
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$title}<?php echo $G['config']['common']['site_title'] ?></title>
    <meta name="keywords" content="{$site_keywords}"/>
    <meta name="description" content="{$site_description}">
    <meta name="author" content="许繁">
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?php echo import('reset.css') ?>
    <?php echo import('common.css') ?>
    <?php echo import('common.js') ?>
    <?php foreach ($G['tpl']['static'] as $static) : ?>
        <?php echo import($static) ?>
    <? endforeach; ?>
</head>
<body>
<div id="wrap">
    <div id="head">
        <h2><a href="<?= $G['config']['app']['siteurl'] ?>"><?php echo $G['config']['common']['site_title'] ?></a></h2>
        <p>承载我的青春</p>
        <ul class="nav-menu">
            <?php foreach ($index_menu as $menu): ?>
                <li><a href="<?php echo U($menu['menu_mod']); ?>"><?php echo $menu['menu_name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>