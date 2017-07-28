<?php
$settings = M('Cms\admin\setting')->getCurdCellByAlias($G['get']['param']['alias']);
$data = T($settings[0]['data_table'])->select(array('id' => $G['get']['param']['id']))[0];

if (!empty($G['post'])) {
    $up = new \Cms\common\Upload();
    $result = $up->upfiles();
    foreach ((array)$result as $key => $res) {
        $G['post'][$key] = $res['path'];
    }
    foreach ((array)$settings as $set) {
        if ($set['option_type'] == 'file') {
            if (empty($G['post'][$set['field']])) {
                $G['post'][$set['field']] = $set['value'];
            }
        }
    }
    if ($G['post']['id']) {
        $data = array_filteri($G['post'], array_column($settings, 'field'));
        if ($G['post']['id']) {
            dump($G['post']);
            foreach ((array)$settings as $key => $set) {
                // if($_FILES[$set['field']]&&!$G['post'][$set['field']]){//解决当无文件上传  没有时图片被置空
                //    continue;
                //}
                $ret = T($set['data_table'])->update(
                    array('id' => $G['post']['id']),
                    array($set['field'] => addslashes($G['post'][$set['field']]))
                );
            }
        }

        msg("修改成功", 'admin/menu/curdlist');
    } else {

        $data = array_filteri($G['post'], array_column($settings, 'field'));

        T($settings[0]['data_table'])->add(
            $data
        );

        msg("添加成功", 'admin/menu/curdlist');
    }
}