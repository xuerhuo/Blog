<html>
<head>
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('common.js') ?>
    <?php echo import('admin_set_setting.css') ?>
    <?php echo import('admin_set_setting.js') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>系统设置</h3>
        <p>系统设置</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>系统管理</a>><a>系统设置</a>
    </nav>
</header>
<div id="content">
    <div class="wrap">
        <div class="title">
            <i class="icon"></i>
            <h3>系统设置</h3>
            <div class="c-menu">
                <a class="selected">系统设置</a>
                <a>添加设置</a>
            </div>
        </div>
        <div class="c-ment-content" id="c-menu-content">
            <form action="" method="post" enctype="multipart/form-data">
                <?php foreach ($setting as $key => $set): ?>
                    <div class="row_my">
                        <div class="lable">
                            <?php echo $set['set_name'] ?>:
                        </div>
                        <div class="fill-elemt">
                            <?php if ($set['option_type'] == 'text'): ?>
                                <input name="<?php echo $set['set_guid']; ?>" type="text"
                                       value="<?php echo htmlspecialchars($set['value']); ?>">
                            <?php endif; ?>
                            <?php if ($set['option_type'] == 'file'): ?>
                                <input name="<?php echo $set['set_guid']; ?>" type="file"
                                       value="<?php echo $set['value'] ?>">
                            <?php endif; ?>
                            <?php if ($set['option_type'] == 'fulltext'): ?>
                                <textarea name="<?php echo $set['set_guid']; ?>"><?php echo $set['value'] ?></textarea>


                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!--            <div class="row_my">-->
                <!--                <div class="lable">-->
                <!--                    站点名称:-->
                <!--                </div>-->
                <!--                <div class="fill-elemt">-->
                <!--                    <input name="" type="text">-->
                <!--                </div>-->
                <!--            </div>-->
                <div class="bottom">
                    <div class="sub">
                        <button class="set-post">提交</button>
                        <button onclick="clearInput();return false;">清除</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="c-ment-content c-menu-addsetting" id="c-menu-addsetting">
            <form action="<?php echo U('admin/set/setting', array('method' => 'addsetting')); ?>">
                <div class="row_my">
                    <div class="lable">
                        选项名称:
                    </div>
                    <div class="fill-elemt">
                        <input type="text" name="set_name">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        选项类型:
                    </div>
                    <div class="fill-elemt">
                        <input name="option_type" type="text">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        菜单别名:
                    </div>
                    <div class="fill-elemt">
                        <input name="menu_alias" type="text">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        唯一标志名:
                    </div>
                    <div class="fill-elemt">
                        <input name="set_guid" type="text">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        选项说明:
                    </div>
                    <div class="fill-elemt">
                        <input name="tips" type="text">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        数据表:
                    </div>
                    <div class="fill-elemt">
                        <input name="data_table" type="text">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        字段:
                    </div>
                    <div class="fill-elemt">
                        <input name="field" type="text">
                    </div>
                </div>
                <div class="bottom">
                    <div class="sub">
                        <button class="post">提交</button>
                        <button onclick="clearInput();return false;">清除</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>