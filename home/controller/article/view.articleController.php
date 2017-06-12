<?php
$article = M('\Cms\admin\article')->getArticles(array('id' => $G['get']['param']['aid']), 1)[0];
$aaroundarticle = M('\Cms\admin\article')->getAroundArticles($article['dateline']);
$comments = M('Cms\home\comments')->getCommentsById($G['get']['param']['aid'], 'article');
$comments = array_diyfiter($comments, 'html');
if ($G['get']['param']['ajax'] == 1) {
    json_output($article['content'], 'text');
}
//$article['content'] = htmlspecialchars($article['content']);
$title = $article['title'] . ' - ';
$site_keywords = $article['tags'];
$site_description = $article['title'];
?>