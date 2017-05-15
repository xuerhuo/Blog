<html>
<head>
    <base href="<?php echo $G['config']['common']['basehref'] ?>">
    <?php echo import('reset.css') ?>
    <?php echo import('admin_base.css') ?>
    <?php echo import('jquery-2.1.0.js') ?>
    <?php echo import('common.js') ?>
    <?php echo import('admin_set_curdmodel.css') ?>
    <?php echo import('admin_set_curdmodel.js') ?>
</head>
<body>
<header>
    <div class="title">
        <h3>curd模型管理</h3>
        <p>curd模型管理</p>
    </div>
    <nav>
        <a href="<?= U('admin/index/main') ?>">主页</a>><a>系统管理</a>><a>curd模型管理</a>
    </nav>
</header>
<div id="content">
    <div class="wrap">
        <div class="title">
            <i class="icon"></i>
            <h3>系统设置</h3>
            <div class="c-menu">
                <a class="selected">添加管理模型</a>
                <a>添加设置</a>
            </div>
        </div>
        <div class="c-ment-content" id="c-menu-content">
            <div>
                <div class="row_my">
                    <div class="lable">
                        管理模型别名:
                    </div>
                    <div class="fill-elemt">
                        <input type="text" name="alias" id="alias">
                    </div>
                </div>

                <div class="row_my">
                    <div class="lable">
                        选择模板:
                    </div>
                    <div class="fill-elemt">
                        <input type="text" name="tpl" id="tpl">
                    </div>
                </div>

                <div class="row_my">
                    <div class="lable">
                        选择模型元素:
                    </div>
                    <div class="fill-elemt">
                        <select name="common_setid" class="sect" id="sect">
                            <?php foreach ($setting as $set_key => $set): ?>
                                <option value="<?php echo $set['sid'] ?>"><?php echo $set['set_name'] . '  ' . $set['set_guid'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
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
                        <button class="set-post" id="submit1">提交</button>
                        <button onclick="clearInput();return false;">清除</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="c-ment-content c-menu-addsetting" id="c-menu-addsetting">
            <div>
                <div class="row_my">
                    <div class="lable">
                        选项名称:
                    </div>
                    <div class="fill-elemt">
                        <input type="text" name="set_name" id="set_name">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        选项类型:
                    </div>
                    <div class="fill-elemt">
                        <input name="option_type" type="text" id="option_type">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        菜单别名:
                    </div>
                    <div class="fill-elemt">
                        <input name="menu_alias" type="text" id="menu_alias">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        唯一标志名:
                    </div>
                    <div class="fill-elemt">
                        <input name="set_guid" type="text" id="set_guid">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        选项说明:
                    </div>
                    <div class="fill-elemt">
                        <input name="tips" type="text" id="tips">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        数据表:
                    </div>
                    <div class="fill-elemt">
                        <input name="data_table" type="text" id="data_table">
                    </div>
                </div>
                <div class="row_my">
                    <div class="lable">
                        字段:
                    </div>
                    <div class="fill-elemt">
                        <input name="field" type="text" id="field">
                    </div>
                </div>
                <div class="bottom">
                    <div class="sub">
                        <button class="post" id="submit2">提交</button>
                        <button onclick="clearInput();return false;">清除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>