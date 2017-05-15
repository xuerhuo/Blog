<html>
<head>
    <meta charset="UTF-8">
    <title>后台登陆</title>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?= import('bootstrap.min.css') ?>
    <?= import('admin_login.css') ?>
    <?= import('jquery.min.js') ?>
    <?= import('bootstrap.min.js') ?>
</head>
<body>
<div class="container">
    <div class="row content">
        <form action="" method="post" class="form-signin col-sm-offset-4 col-sm-4" role="form">
            <h2 class="form-signin-heading">登陆面板</h2>
            <? if ($G['post']): ?>
                <div class="alert alert-danger">用户名或密码错误</div>
            <? endif; ?>
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" name="username" id="username" required class="form-control input-block-level"/>
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" name="password" id="password" required class="form-control input-block-level"/>
            </div>
            <input type="submit" value="登陆" class="btn btn-large pull-right btn-primary"/>
        </form>
    </div>
</div>

</body>
</html>