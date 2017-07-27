<?php

namespace Cms\admin;
class settingModel extends \Cms\core\Model
{
    public function getConfig()
    {
        $setting = T('common_setting')->select(array(
            'menu_alias' => 'common'
        ));
        foreach ((array)$setting as $set) {
            $data[$set['set_guid']] = $set['value'];
        }
        return $data;
    }

    public function getCurdCellByAlias($alias, $display = null)
    {
        $where = array(
            'menu_alias' => $alias
        );
        if ($display != null) {
            $where['listdisplay'] = $display;
        }
        $settings = T('common_setting')->select($where);
        return $settings;
    }

    public function getResultByAlias($alias, $order = 'asc')
    {
        $order = $order == 'asc' ? 'asc' : 'desc';
        return T('common_setting_' . $alias)->orderby('id', $order)->select();
    }

    public function getResultById($id, $alias)
    {
        if (!is_array($id)) {
            $id = array(
                'id' => $id
            );
        }
        return T('common_setting_' . $alias)->find($id);
    }

    public function getAboutMe()
    {
        $data = T('common_setting_new')->find(array());
        $data['unhtmlcontent'] = mb_substr(strip_tags($data['content']), 0, 200, 'utf-8');
        return $data;
    }
}

?>