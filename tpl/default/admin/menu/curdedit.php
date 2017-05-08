<html>
<head>
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('common.js') ?>
    <?php echo import('admin_menu_curdedit.css') ?>
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
                <a>编辑设置</a>
            </div>
        </div>
        <div class="c-ment-content" id="c-menu-content">
            <form action="" method="post" enctype="multipart/form-data">
                <input name="id" value="<?php echo $G['get']['param']['id'] ?>" type="hidden">
                <?php foreach ($settings as $key => $set): ?>
                    <div class="row_my">
                        <div class="lable">
                            <?php echo $set['set_name'] ?>:
                        </div>
                        <div class="fill-elemt">
                            <?php if ($set['option_type'] == 'text'): ?>
                                <input name="<?php echo $set['field']; ?>" type="text"
                                       value="<?php echo $data[$set['field']] ?>">
                            <?php endif; ?>
                            <?php if ($set['option_type'] == 'file'): ?>
                                <input name="<?php echo $set['field']; ?>" type="file"
                                       value="<?php echo $data[$set['field']] ?>">
                            <?php endif; ?>
                            <?php if ($set['option_type'] == 'fulltext'): ?>
                                <textarea
                                        name="<?php echo $set['field']; ?>"><?php echo $data[$set['field']] ?></textarea>
                            <?php endif; ?>


                            <?php if ($set['option_type'] == 'html'): ?>
                                <script type="text/javascript" charset="utf-8"
                                        src="<?php echo DATA_LIB . 'ueditor/' ?>ueditor.config.js"></script>
                                <script type="text/javascript" charset="utf-8"
                                        src="<?php echo DATA_LIB . 'ueditor/' ?>ueditor.all.min.js"></script>
                                <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                                <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                                <script type="text/javascript" charset="utf-8"
                                        src="<?php echo DATA_LIB . 'ueditor/' ?>lang/zh-cn/zh-cn.js"></script>
                                <script id="editor" type="text/plain"
                                        name="<?php echo $set['field']; ?>"><?php echo $data[$set['field']] ?></script>
                                <script type="text/javascript">

                                    //实例化编辑器
                                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                    var ue = UE.getEditor('editor');
                                </script>

                            <?php endif; ?>


                        </div>
                    </div>
                <?php endforeach; ?>
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