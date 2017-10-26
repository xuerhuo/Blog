{include include/common_header}
    <div id="content">
        <ul class="article_list">
            <?php foreach ($lists as $list): ?>
                <li>
                    <h3 class="title"><a
                                href="<?php echo U('home/article/view', array('aid' => $list['id'])) ?>"> <?php echo $list['title'] ?></a>
                    </h3>
                    <p class="article_content">
                        <?php echo $list['content_sumary'] ?>
                    </p>
                    <a href="<?php echo U('home/article/view', array('aid' => $list['id'])) ?>" class="read_all">阅读全文</a>
                    <p class="article_des">本文章发布于<?php echo date('Y', $list['dateline']); ?>
                        年<?php echo date('m', $list['dateline']); ?>月<?php echo date('d', $list['dateline']); ?>日 分类:未分类</p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="nav">
        <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=280 height=450
                src="//music.163.com/outchain/player?type=0&id=118004103&auto=0&height=430"></iframe>
        <span style="text-decoration: underline;"><span style="color: #333333; text-decoration: underline;"><strong><a
                            style="color: #333333; text-decoration: underline;"
                            href="http://www.jermey.cn/">四少爷’blog</a></strong></span></span> <strong><a
                    style="color: #333333; text-decoration: underline;" href="http://yige.org">一个’blog</a> </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.jurieo.com">俊霖’blog</a>
        </strong> <strong><a style="color: #333333; text-decoration: underline;"
                             href="http://www.yangbin.cc">杨彬’blog</a> </strong>
        <strong><a style="color: #333333; text-decoration: underline;" title="http://dongdong.name/">东东博客</a> </strong>
        </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.w0ai1uo.org">w0ai1ou'blog</a>
        </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.sakill.com">SAKILL的博客</a>
        </strong>
        <strong><a style="color: #333333; text-decoration: underline;" href="http://www.inzhuo.cn/">卓的云</a></strong>
        <strong><a style="color: #333333; text-decoration: underline;" title="http://deepon.cn">Deep'blog</a></strong>
    </div>
{include include/common_footer}
