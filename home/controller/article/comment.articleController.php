<?php
if (!empty($G['post'])) {
    if ($G['post']['method'] == "add") {
        $status = T('common_comments')->add(array(
            'type' => addslashes($G['post']['type']),
            'index_id' => addslashes($G['post']['id']),
            'comment_name' => addslashes($G['post']['comment_name']),
            'comment_content' => addslashes($G['post']['comment_content']),
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