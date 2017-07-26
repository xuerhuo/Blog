<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?php echo import('reset.css') ?>
    <?php echo import('admin_base.css') ?>
    <?php echo import('jquery.min.js') ?>
    <?php echo import('bootstrap.css') ?>
    <?php echo import('bootstrap.min.js') ?>
    <?php echo import('admin_user_group.js') ?>
    <?php echo import('admin_article_cat.css') ?>
</head>
<body>
<header>
    <div class="title">
        <h3><?php echo $menu[0]['menu_name'] ?></h3>
        <p><?php echo $menu[0]['menu_name'] ?></p>
    </div>
    <nav>
        <a href="<?php echo U('admin/index/main') ?>">主页</a>><a><?php echo $menu[1]['menu_name'] ?></a>><a
                href="<?php echo U('admin/article/index') ?>"><?php echo $menu[0]['menu_name'] ?></a>
    </nav>
</header>
<div class="wrap">
    <div class="post_box">
        <div class="title"><h2><span class="glyphicon  glyphicon-pencil"></span>编辑/添加分组</h2></div>
        <form action="" method="post">
            <input type="hidden" name="id" id="id" value="0">
            <div class="row_my">
                <label for="group_name">用户组名:</label>
                <input type="text" name="group_name">
            </div>
            <div class="row_my" style="display: none;">
                <label for="cat_parent">上级用户组:</label>
                <select name="parent_group">
                    <option value="0" selected></option>
                    <?php foreach ($groups as $group): ?>
                        <option value="<?php echo $group['id'] ?>"><?php echo $group['group_name'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="bottom">
                <div class="sub">
                    <button onclick="this.form.sbumit()"><span class="glyphicon glyphicon-ok"></span>提交</button>
                    <button onclick="clearInput();return false;"><span class="glyphicon glyphicon-remove"></span>清除
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="cats_display">
        <div class="title"><h2><span class="glyphicon  glyphicon-list"></span>用户组列表</h2></div>
        <ul>
            <li>
                <span class="item">#</span>
                <span class="cat_name">用户组名</span>
                <span class="parent_id">上级用户组</span>
                <span class="edit">操作</span>
            </li>
            <?php foreach ($groups as $group): ?>
                <li>
                    <span class="item"><?php echo $group['id'] ?></span>
                    <span class="cat_name"><?php echo $group['group_name'] ?></span>
                    <span class="parent_id"><?php echo $group['parent_group'] ?></span>
                    <span class="edit">
                        <a href="#" onclick="group_edit (this)" id="group_<?php echo $group['id'] ?>" class="">编辑</a>
                        <a href="<?php echo U('admin/user/group', array('delete' => $group['id'])) ?>">删除</a>
                        <a href="<?php echo U('admin/user/user', array('group' => $group['id'])) ?>">   <?php echo $group['count'] ?></a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</body>
</html>