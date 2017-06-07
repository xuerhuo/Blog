<?php
/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/6/1
 * Time: 11:51
 */

namespace Cms\core;


class Template
{
    public $tpl_content;                     //要编译的文件
    public $cache_file_name;
    private $tpl;            //生成文件路径
    private $cache_path;             //
    private $file_hash;        //生成文件的后缀
    private $tpl_ext = '.php';        //生成文件的前缀
    private $tpl_pre = 'tpl_';      //生成文件的全路径
    private $reg_exp;
    private $search_replace = array();
    private $debug;

    public function __construct()
    {
        global $G;
        $this->debug = $G['config']['app']['debug'];
        $this->cache_path = $G['config']['app']['tpl_cache_path'];

    }

    public function createTpl($path_to_src)
    {
        $this->tpl_pre .= str_replace('/', '_', str_replace(TPL, '', $path_to_src));
        $this->tpl = $path_to_src;
        $this->file_hash = sha1($path_to_src);
        $this->cache_file_name = $this->cache_path . $this->tpl_pre;

        if (!file_exists($this->cache_file_name) || $this->debug) {
            $this->tpl_content = $this->readContent($this->tpl);
            $this->compile($this->tpl_content);
            $this->output();
        }
    }
    public function readContent($file_path)
    {
        return file_get_contents($file_path);
    }

    public function compile(&$content)
    {
        $this->replaceRule();
        foreach ($this->search_replace as $key => $value) {
            $content = str_replace($key, $value, $content);
        }
        foreach ($this->reg_exp as $key => $value) {
            $content = preg_replace($key, $value, $content);
        }
    }

    public function replaceRule()
    {
        $this->search_replace = array(
            '<?=' => '<?php echo ',
            '{/foreach}' => '<?php endforeach;?>',
            '{/if}' => '<?php endif;?>',
        );
        $this->reg_exp = array(
            '/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\[\]\'\"\$->]*)\}/' => '<?php echo $\1;?>',//$value $value[123] $value['123'] $value[$kdf] $this->df
            '/{foreach ([a-zA-Z-_0-9\$>\(\)]*) ([a-zA-Z-_0-9\$>\(\)]*)}/' => "<?php foreach((array)\\1 as \\2):?>",
            '/{foreach ([a-zA-Z-_0-9\$>\(\)]*) ([a-zA-Z-_0-9\$>\(\)]*) ([a-zA-Z-_0-9\$>\(\)]*)}/' => "<?php foreach((array)\\1 as \\2=>\\3):?>",
            '/{([a-zA-Z_][a-zA-Z_-]*\(.*\))}/' => '<?php echo \\1?>',//匹配输出函数
            '/{1if ([a-zA-Z-_0-9\$><=\(\)]*)}/' => '<?php if(\\1):?>',
            '/{elseif ([a-zA-Z-_0-9\$><=\(\)]*)}/' => '<?php elseif(\\1):?>',
            '/{include ([a-zA-Z-_0-9\/]*)}/ies' => "\$this->parseInclude('\\1')",
        );
    }

    public function output()
    {
        $this->writeContent($this->cache_file_name);
    }

    public function writeContent($filepath)
    {
        return file_put_contents($filepath, $this->tpl_content);
    }

    public function parseInclude($include_file)
    {
        $include_file = TPL . $include_file . '.php';
        $content = $this->readContent($include_file);
        $this->compile($content);
        return $content;
    }

    public function clear()
    {
        $ret['statuc'] = true;
        $files = scanpath($this->cache_path);
        foreach ($files as $file) {
            if (unlink($file)) {
                $ret['message'] .= 'deleted ' . $file . "\r\n";
            }
        }
        $templates = scanpath(TPL);
        foreach ($templates as $src) {
            if (get_extension($src) == 'php') {
                template($src);
                $ret['message'] .= 'creat ' . $src . "\r\n";
            }
        }
        return $ret;
    }
}