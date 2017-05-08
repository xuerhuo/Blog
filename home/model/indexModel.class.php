<?php

namespace Cms\home;
class indexModel extends \Cms\core\Model
{

    public function test()
    {
        return Cms\core\db::select('users');
    }

    public function get_sys_config()
    {
        return Cms\core\db::find('config', array('name' => 'sys_cron'));
    }

    public function update_sys_cron($data)
    {
        return Cms\core\db::update('config', array('name' => 'sys_cron'), $data);
    }

    public function getNewArticles($page, $pagenum, $content_sumary = 400)
    {
        $aarticle = T('articles')->orderby('dateline', 'DESC')->page($page, $pagenum)->select(array(
            'cat!=2',
            'status' => 1
        ));
        foreach ($aarticle as $key => $article) {
            $aarticle[$key]['content_sumary'] = htmlspecialchars(mb_substr($article['content'], 0, $content_sumary, 'UTF-8'));
        }

        return $aarticle;
    }
}

?>