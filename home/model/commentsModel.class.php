<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/2/21
 * Time: 18:59
 */

namespace Cms\home;
class commentsModel extends \Cms\core\Model
{
    function getCommentsById($aid, $type = 'article')
    {
        return T('comments')->select(array(
            'type' => $type,
            'index_id' => $aid,
        ));
    }
}