<?php

namespace Cms\core;
if (!defined('IN'))
    exit('not in web interface');

class app
{
    public $d;
    public $f;
    public $m;
    public $contronllerpath;
    public $modelpath;
    public $tplpath;

    public function __construct()
    {
        global $G;
        $this->d = $G['get']['d'] ? $G['get']['d'] : 'home';
        $this->f = $G['get']['f'] ? $G['get']['f'] : 'index';
        $this->m = $G['get']['m'] ? $G['get']['m'] : 'index';
        $G['get']['d'] = $this->d;
        $G['get']['f'] = $this->f;
        $G['get']['m'] = $this->m;
        $this->initSession();
    }

    public function initSession()
    {
        session_start();
    }

    public function loadconf($parse)
    {
        if (file_exists(ROOT . 'data/' . $parse . '.conf.php')) {
            require_once ROOT . 'data/' . $parse . '.conf.php';
        } else {
            die($parse . 'conf not exist');
        }
        return $config;
    }

    public function checkurl(&$G)
    {
        dump($G);
        foreach ($G['get'] as $k => $v) {
            $v = checkstr($v, $G['sec']['strrep']);
            $G['get'][$k] = $v;
        }
    }

    public function loadclass($parse)
    {
        if (!file_exists(ROOT . 'class' . $parse . '.class.php')) {
            include_once ROOT . 'class/' . $parse . '.class.php';
        } else {
            die($parse . 'class not exist');
        }
        return new $parse();

    }

    public function initModel()
    {
        global $G;
        $this->modelpath = ROOT . $this->d . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . $this->f . 'Model.class.php';
        if (file_exists($this->modelpath)) {
            require_once $this->modelpath;
            $cl = 'Cms\\' . $G['get']['d'] . '\\' . $this->f . 'Model';
            return new $cl;
        }
    }

    public function initController()
    {
        $this->controllerpath = ROOT . $this->d . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $this->f . DIRECTORY_SEPARATOR . $this->m . '.' . $this->f . 'Controller.php';
        if (file_exists($this->controllerpath)) {
            return $this->controllerpath;
            /// require_once $this->controllerpath;
        } else {
            return;
        }
    }

    public function initView($path = null)
    {
        $this->tplpath = TPL . $this->d . DIRECTORY_SEPARATOR . $this->f . DIRECTORY_SEPARATOR . $this->m . '.php';
        if (file_exists(TPL . $path) && $path)
            $this->tplpath = TPL . $path;
        if (file_exists($this->tplpath)) {
            return $this->tplpath;
            //require_once $this->tplpath;
        } else {
            // die($this->tplpath.' not found');
        }
    }

    public function reload()
    {

    }

    private function loadfunc($parse)
    {
        if (file_exists(ROOT . 'com/' . $parse . '.func.php')) {
            require_once ROOT . 'com/' . $parse . '.func.php';
        } else {
            die($parse . 'func not exist');
        }
    }
}

?>