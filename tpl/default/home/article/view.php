<?php
add_tpl_static('jquery-2.1.0.js');
add_tpl_static('marked.js');
add_tpl_static(DATA_LIB . 'editor/lib/marked.min.js');
add_tpl_static(DATA_LIB . 'editor/lib/prettify.min.js');
add_tpl_static(DATA_LIB . 'editor/lib/raphael.min.js');
add_tpl_static(DATA_LIB . 'editor/lib/underscore.min.js');
add_tpl_static(DATA_LIB . 'editor/lib/sequence-diagram.min.js');
add_tpl_static(DATA_LIB . 'editor/lib/flowchart.min.js');
add_tpl_static(DATA_LIB . 'editor/lib/jquery.flowchart.min.js');
add_tpl_static(DATA_LIB . 'editor/editormd.js');
add_tpl_static(DATA_LIB . 'editor/css/editormd.preview.css');
?>
{include include/common_header}
    <div id="content">
        <h3 class="title"><?= $article['title'] ?></h3>
        <div id="article_content">
            <pre id="markdown"><?= $article['content'] ?></pre>
            <pre id="markdown-view"></pre>
            <p class="content_des">本条目发表于<?= date('Y', $article['dateline']) ?>年<?= date('m', $article['dateline']) ?>
                月<?= date('d', $article['dateline']) ?>日。属于<b><?= $article['cat_name'] ?></b>分类</p>
        </div>
        <div class="around-article">
            <? if (!empty($aaroundarticle[0])): ?>
                <a class="pre"
                   href="<?= U('home/article/view', array('aid' => $aaroundarticle[0]['id'])) ?>">←<?= $aaroundarticle[0]['title'] ?></a>
            <? endif; ?>
            <? if (!empty($aaroundarticle[1])): ?>
                <a class="next"
                   href="<?= U('home/article/view', array('aid' => $aaroundarticle[1]['id'])) ?>"><?= $aaroundarticle[1]['title'] ?>
                    →</a>
            <? endif; ?>
        </div>
        <div id="comment">
            <ul class="comment-list">
                <li><h4>评论列表</h4></li>
                {foreach $comments $comment}
                <li class="comment-item">
                    <p class="comment_name">{$comment['comment_name']}</p>
                    <p class="comment_time"> 发表时间:{date('Y-m-d H:i:s',$comment['dateline'])}</p>
                    <p class="comment_content">{$comment['comment_content']}</p>
                </li>
                {/foreach}
            </ul>
            <form action="<?php echo U('home/article/comment'); ?>" method="post" onsubmit="return">
                <input type="text" name="coment_name" id="comment_name" placeholder="姓名">
                <input type="hidden" name="id" id="article_id" value="<?php echo $G['get']['param']['aid']; ?>">
                <textarea name="coment_content" id="comment_content" required></textarea>
                <button class="btn" type="button">提交</button>
            </form>
        </div>
    </div>
    <div id="nav">
        <iframe frameborder="no" border="0" marginwidth="0" marginheight="0" width=280 height=450
                src="//music.163.com/outchain/player?type=0&id=118004103&auto=0&height=430"></iframe>
    </div>
{include include/common_footer}