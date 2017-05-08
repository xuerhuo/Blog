<?php
if ($G['post']) {
    $ret = $C['Admin']->modifypass($G['post']['oldpass'], $G['post']['newpass']);
    if ($ret['status']) {
        msg('修改成功', 'admin/user/modifypass');
    } else {
        msg('修改失败', 'admin/user/modifypass');
    }
}
?>