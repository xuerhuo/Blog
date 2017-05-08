<html>
<head>
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('admin_menu_index.css') ?>
    <?= import('jquery-2.1.0.js') ?>
    <?= import('admin_menu_index.js') ?>
    <?= import('bootstrap.css') ?>
    <?= import('bootstrap.min.js') ?>
    <style type="text/css">
        .icon {
        }
    </style>
</head>
<body>
<header>
    <div class="title">
        <h3>菜单选项</h3>
        <p>菜单选项</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>系统管理</a>><a>菜单管理</a>
    </nav>
</header>
<form action="" method="post">
    <ul class="menu-list">
        <li>
            <div class="menu-id">编号</div>
            <div class="menu-name">名称</div>
            <div class="url-mod">模块</div>
            <div class="status">隐藏</div>
            <div class="sup-menu">上级菜单</div>
            <div class="icon">图标</div>
            <div class="sequence">排序</div>
        </li>
        <?php foreach ($menus as $menu): ?>
            <li data-level="<?= $menu['level'] ?>">
                <div class="menu-id"><?= $menu['id'] ?></div>
                <div class="menu-name"><input type="text" value="<?= $menu['menu_name'] ?>"
                                              name="menu_name[<?= $menu['id'] ?>]"></div>
                <div class="url-mod"><input type="text" value="<?= $menu['menu_mod'] ?>"
                                            name="menu_mod[<?= $menu['id'] ?>]"></div>
                <div class="status"><input type="radio" value="0" name="hide[<?= $menu['id'] ?>]"
                                           <? if ($menu['hide'] == 0): ?>checked<? endif; ?>>不隐藏 <input type="radio"
                                                                                                        value="1"
                                                                                                        name="hide[<?= $menu['id'] ?>]"
                                                                                                        <? if ($menu['hide'] == 1): ?>checked<? endif; ?>>
                    隐藏
                </div>
                <div class="sup-menu">
                    <!--<input type="text" value="<?= $menu['parent_id'] ?>" name="parent_id[<?= $menu['id'] ?>]"> -->
                    <select name="parent_id[<?= $menu['id'] ?>]">
                        <option value="0">顶级菜单</option>
                        <?php foreach ($menus as $opval): ?>
                            <option value="<?= $opval['id'] ?>"
                                    <? if ($menu['parent_id'] == $opval['id']): ?>selected<? endif; ?>><?= $opval['menu_name'] ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="icon">
                    <input type="text" value="<?= $menu['icon'] ?>" name="icon[<?= $menu['id'] ?>]">
                </div>
                <div class="sequence"><input type="text" value="<?= $menu['sequence'] ?>"
                                             name="sequence[<?= $menu['id'] ?>]"></div>
                <div class="type"><select name="ntype">
                        <option value="admin_panel" <?php if ($menu['type'] == 'admin_panel'): ?>selected<? endif; ?>>
                            后台菜单
                        </option>
                        <option value="index_menu" <?php if ($menu['type'] == 'index_menu'): ?>selected<? endif; ?>>
                            前台菜单
                        </option>
                    </select></div>
            </li>
        <? endforeach; ?>
        <li>
            <div class="menu-id">添加</div>
            <div class="menu-name"><input type="text" value="" name="nmenu_name"></div>
            <div class="url-mod"><input type="text" value="" name="nmenu_mod"></div>
            <div class="status"><input type="text" value="" name="nhide"></div>
            <div class="sup-menu">
                <!--            <input type="text" value="" name="nparent_id">-->
                <select name="nparent_id">
                    <option value="0">顶级菜单</option>
                    <?php foreach ($menus as $opval): ?>
                        <option value="<?= $opval['id'] ?>"
                                <? if ($menu['parent_id'] == $opval['id']): ?>selected<? endif; ?>><?= $opval['menu_name'] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="icon"><input type="text" value="" name="nicon"></div>
            <div class="sequence"><input type="text" value="" name="nsequence"></div>
            <select name="ntype">
                <option value="admin_panel">后台菜单</option>
                <option value="index_menu">前台菜单</option>
            </select>
            <!--        <input type="hidden" value="admin_panel" name="ntype">-->
        </li>
        <li>
            <input type="submit" value="submit">
        </li>
    </ul>
</form>
</body>
</html>