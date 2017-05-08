<html>
<head>
    <?php echo import('reset.css') ?>
    <?php echo import('admin_base.css') ?>
    <?php echo import('admin_user_user.css') ?>
    <?php echo import('font-awesome.min.css') ?>
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
    <div class="content">
        <div class="title">
            <i class="fa  fa-user"></i><h4>用户列表</h4>
        </div>
        <div class="top">
            <a href="">添加用户<i class="fa fa-plus"></i></a>
            <div class="search">
                <p>用户名:</p><input type="text" name="search">
                <button class="btn">搜索</button>
            </div>
        </div>

        <div class="user-data">
            <table>
                <tr>
                    <td>选择</td>
                    <td>用户名</td>
                    <td>昵称</td>
                    <td>用户组</td>
                    <td>角色</td>
                    <td>操作</td>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>选择</td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['nickname'] ?></td>
                        <td><?php echo $user['groupname'] ?></td>
                        <td>角色</td>
                        <td>操作</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>