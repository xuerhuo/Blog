<?php
$lists = $M->getNewArticles(isset($G['get']['param']['p']) ? $G['get']['param']['p'] : 0, 20);
$index_menu = M('\Cms\admin\menu')->getMenuByType('index_menu');
?>