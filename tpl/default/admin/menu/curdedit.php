<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?= import('reset.css') ?>
    <?= import('admin_base.css') ?>
    <?= import('common.js') ?>
    <?php echo import('admin_menu_curdedit.css') ?>
    <?php echo import('admin_menu_curdedit.js') ?>

    <script type="text/javascript" charset="utf-8"
            src="<?php echo DATA_LIB . 'ueditor/' ?>ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="<?php echo DATA_LIB . 'ueditor/' ?>ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8"
            src="<?php echo DATA_LIB . 'ueditor/' ?>lang/zh-cn/zh-cn.js"></script>
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
                            <?php if ($set['option_type'] == 'img'): ?>
                                <input name="<?php echo $set['field']; ?>" type="text"
                                       value="<?php echo $data[$set['field']] ?>" readonly
                                       onclick="window.open('{$G['config']['app']['siteurl']}'+this.value);return false;">
                                <div class="upload-btn" onclick="openuploadframe('<?php echo $set['field']; ?>')">点击上传
                                </div>
                            <?php endif; ?>

                            <?php if ($set['option_type'] == 'fulltext'): ?>
                                <textarea
                                        name="<?php echo $set['field']; ?>"><?php echo $data[$set['field']] ?></textarea>
                            <?php endif; ?>

                            <?php if ($set['option_type'] == 'select'): ?>
                                <?php
                                $json = json_decode($set['value'],1);
                                $json['index_field'] = $json['index_field'] ? $json['index_field']:'id';
                                $options = T($json['table'])->select($json['where']);
                                ?>
                                <select name="{$set['field']}">
                                    {foreach $options $opt}
                                    <option value="{$opt[$json['index_field']]}">{$opt[$json['field']]}</option>
                                    {/foreach}
                                </select>
                            <?php endif; ?>



                            <?php if ($set['option_type'] == 'html'): ?>

                                <script id="editor{$set['field']}" type="text/plain"
                                        name="<?php echo $set['field']; ?>"><?php echo $data[$set['field']] ?></script>
                                <script type="text/javascript">
                                    var ue = UE.getEditor('editor{$set['field']}');
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
<textarea id="ueditor">

</textarea>
</body>
</html>