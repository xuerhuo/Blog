<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?php echo import('reset.css') ?>
    <?php echo import('admin_base.css') ?>
    <?php echo import('jquery.min.js') ?>
    <?php echo import('bootstrap.css') ?>
    <?php echo import('bootstrap.min.js') ?>
    <?php echo import('admin_article_cat.js') ?>
    <?php echo import('admin_article_cat.css') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>分类管理</h3>
        <p>分类管理</p>
    </div>
    <nav>
        <a href="<?php echo U('admin/index/main') ?>">主页</a>><a>内容管理</a>><a href="<?php echo U('admin/article/index') ?>">分类管理</a>
    </nav>
</header>
<div class="wrap">
    <div class="post_box">
        <div class="title"><h2><span class="glyphicon  glyphicon-pencil"></span>编辑/添加分类</h2></div>
        <form action="" method="post">
            <input type="hidden" name="cat_id" id="cat_id" value="0">
            <div class="row_my">
                <label for="cat_name">分类名:</label>
                <input type="text" name="cat_name">
            </div>
            <div class="row_my">
                <label for="cat_parent">上级分类:</label>
                <select name="parent_cat">
                    <option value="0" selected></option>
                    <?php foreach ($cats as $cat): ?>
                        <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                    <?php endforeach; ?>
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
        <div class="title"><h2><span class="glyphicon  glyphicon-list"></span>分类列表</h2></div>
        <ul>
            <li>
                <span class="item">#</span>
                <span class="cat_name">分类名</span>
                <span class="parent_id">父类</span>
                <span class="edit">操作</span>
            </li>
            <?php foreach ($cats as $cat): ?>
                <li>
                    <span class="item"><?php echo $cat['cat_id'] ?></span>
                    <span class="cat_name"><?php echo $cat['cat_name'] ?></span>
                    <span class="parent_id"><?php echo $cat['parent_name'] ?></span>
                    <span class="edit"><a href="#" onclick="cat_edit(this)" id="cat_<?php echo $cat['cat_id'] ?>"
                                          class="">编辑</a>  <a
                                href="<?php echo U('admin/article/cat_delete/' . $cat['cat_id']) ?>">删除</a> </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</body>
</html>