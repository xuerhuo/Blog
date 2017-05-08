<?php
$article = M('\Cms\admin\article')->getArticles(array('id' => $G['get']['param']['aid']))[0];
$aaroundarticle = M('\Cms\admin\article')->getAroundArticles($article['dateline']);
$comments = M('Cms\home\comments')->getCommentsById($G['get']['param']['aid'], 'article');
if ($G['get']['param']['ajax'] == 1) {
    json_output($article['content'], 'text');
}
$article['content'] = htmlspecialchars($article['content']);
?>