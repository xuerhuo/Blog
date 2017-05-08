<?php

namespace Cms\admin;
class articleModel extends \Cms\core\Model
{
    public function getArticles($where = null, $content_sumary = 20)
    {
        $data = T('articles')->orderby('dateline', 'desc')->select($where);
        foreach ($data as $key => $art) {
            // $data[$key]['content']=htmlspecialchars_decode($data[$key]['content']);
            $data[$key]['content_sumary'] = htmlspecialchars(mb_substr($art['content'], 0, $content_sumary, 'UTF-8'));
            $data[$key]['cat_name'] = T('cats')->find(array('cat_id' => $art['cat']))['cat_name'];
            $tags = $this->getArticleTags($art['id']);
            if ($tags)
                $data[$key]['tags'] = implode(',', array_coli($tags, 'tag_name'));
        }
        return $data;
    }

    public function getArticleTags($id)
    {
        return \Cms\core\db::query("select a.tag_name from " . \Cms\core\db::table('tags') . " a," . \Cms\core\db::table('article_tags') . " b where  b.article_id=" . $id . " and a.tag_id=b.tag_id");
    }

    public function getAroundArticles($id)
    {
        $data[1] = T('articles')->orderby('dateline', 'desc')->page(1, 1)->select(array('dateline>' . $id,
            'title!=\'\''))[0];
        $data[0] = T('articles')->orderby('dateline', 'desc')->page(1, 1)->select(array('dateline<' . $id,
            'title!=\'\''))[0];
        return $data;

    }

    public function delArticle($id)
    {
        return T('articles')->delete(array('id' => intval($id)));
    }

    public function addArticle($arr)
    {
        global $C;
        $data = array(
            'title' => addslashes($arr['title']),
            'content' => addslashes($arr['content']),
            'cat' => $arr['cat'],
            'author' => $C['Admin']->nickname,
            'author_id' => $C['Admin']->uid,
            'dateline' => $arr['dateline'] ? $arr['dateline'] : time()
        );
        $status = T('articles')->add($data);
        $this->updateTags(T('articles')->getLastid(), $arr['tags']);
        return $status;
    }

    public function updateTags($article_id, $tags_str)
    {
        if (empty($tags_str)) return 0;
        $tags = explode(',', $tags_str);
        foreach ($tags as $tag) {
            T('tags')->save(array('tag_name' => $tag));
            $tag_id = T('tags')->find(array('tag_name' => $tag))['tag_id'];
            T('article_tags')->save(array('article_id' => $article_id, 'tag_id' => $tag_id));
        }
        $sql = "delete from " . \Cms\core\db::table('article_tags') . " where id in(select a.id from(select id from " . \Cms\core\db::table('article_tags') . " atag," . \Cms\core\db::table('tags') . " tags where atag.article_id=" . $article_id . " and tags.tag_id=atag.tag_id and tag_name not in(" . implode(',', array_untrim($tags, '\'')) . "))a)";//删除更新后不存在的标签
        \Cms\core\db::query($sql);
        return true;
    }

    public function saveArticle($save)
    {
        $index = array(
            'id' => $save['article_id']
        );
        $data = array(
            'title' => addslashes($save['title']),
            'content' => addslashes($save['content']),
            'status' => addslashes($save['status']),
            'cat' => $save['cat']
        );
        $status = $this->updateTags($save['article_id'], $save['tags']);
        return T('articles')->update($index, $data) || $status;
    }

    public function getCats()
    {
        $sql = 'select a.cat_id,a.cat_name,a.parent_cat parent_id,b.cat_name parent_name from ' . \Cms\core\db::table('cats') . ' as a 
        left join ' . \Cms\core\db::table('cats') . ' as b on a.parent_cat=b.cat_id';
        return \Cms\core\db::query($sql);
    }

    public function updateCat($data)
    {
        $id = $data['cat_id'];
        unset($data['cat_id']);
        return T('cats')->update(array('cat_id' => $id), $data);
    }

    public function addCat($data)
    {
        unset($data['cat_id']);
        return T('cats')->add($data);
    }
}

?>