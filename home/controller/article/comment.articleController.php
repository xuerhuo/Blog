<?php
header('Access-Control-Allow-Origin:*');
if (!empty($G['post'])) {
    if ($G['post']['method'] == "add") {
        $status = T('comments')->add(array(
            'type' => 'article',
            'index_id' => addslashes($G['post']['id']),
            'comment_name' => strfiter($G['post']['comment_name'], 'html,sqlinjection'),
            'comment_content' => strfiter($G['post']['comment_content'], 'html,sqlinjection'),
            'dateline' => time(),
        ));
        json_output(array(
            'status' => $status,
        ));
    }
} else {
    msg('没收收到数据');
}
?>