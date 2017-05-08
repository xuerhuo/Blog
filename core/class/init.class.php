<?php

namespace Cms\core;
if (!defined('IN'))
    exit('not in web interface');

class init
{
    public function __construct()
    {
        $this->loadsysfunc('com');
        $this->loadsysfunc('sec');
        $this->loadsysfunc('system');
        //      $this->checkurl();
    }

    private function loadsysfunc($parse)
    {
        if (file_exists(CORE . 'com/' . $parse . '.func.php')) {
            require_once CORE . 'com/' . $parse . '.func.php';
        } else {
            die($parse . 'func not exist');
        }
    }

    public function loadsysconf($parse)
    {
        if (file_exists(CORE . 'data/' . $parse . '.conf.php')) {
            require_once CORE . 'data/' . $parse . '.conf.php';
        } else {
            die($parse . 'conf not exist');
        }
        return $config;
    }

    public function checkurl(&$G)
    {
        // dump($G);
        $G['get'] = array_diyfiter($G['get'], 'sqlinjection');
    }

    public function loadsysclass($parse)
    {
        if (!file_exists(CORE . 'class' . $parse . '.class.php')) {
            include_once CORE . 'class/' . $parse . '.class.php';
        } else {
            die($parse . 'class not exist');
        }
        return new $parse();

    }
}

?>