<html>
<head>
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('common.js') ?>
    <?php echo import('admin_user_modifypass.css') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>修改密码</h3>
        <p>修改密码</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>用户管理</a>><a>修改密码</a>
    </nav>
</header>
<div id="content">
    <div class="wrap">
        <div class="title">
            <i class="icon"></i>
            <h3>修改密码</h3>
            <div class="c-menu">
                <a class="selected">修改密码</a>
            </div>
        </div>
        <div class="c-ment-content" id="c-menu-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row_my">
                    <div class="lable">
                        原密码:
                    </div>
                    <div class="fill-elemt">
                        <input name="oldpass" type="text" value="">
                    </div>
                </div>

                <div class="row_my">
                    <div class="lable">
                        新密码:
                    </div>
                    <div class="fill-elemt">
                        <input name="newpass" type="text">
                    </div>
                </div>
                <div class="bottom">
                    <div class="sub">
                        <button class="set-post">提交</button>
                        <button onclick="clearInput();return false;">清除</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>