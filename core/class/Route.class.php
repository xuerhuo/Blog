<?php

namespace Cms\core;
class Route
{
    public $dfm;
    public $param;
    public $pathinfo;
    private $route_conf = 'route';
    private $route = array();

    public function __invoke()
    {
        $this->__construct();
    }

    public function __construct()
    {
        global $G;
        if (file_exists(ROOT . 'data/' . $this->route_conf . '.conf.php')) {
            require_once ROOT . 'data/' . $this->route_conf . '.conf.php';
        }
        $this->route = $config;


        $this->pathinfo = $this->getPathInfo();
        $this->getArray();
        $this->bindMvc();
        $G['get'] = $this->dfm;
        $this->initParam();
        $G['get']['param'] = $this->param;
    }

    private function getPathInfo()
    {
        $result = '';
        global $G;
        if ($G['pathinfo']) {
            $result = $G['pathinfo'];
        }
        if ($G['get']['p']) {
            $result = $G['get']['p'];
        } else {
            $result = $G['pathinfo'];
        }
        $result = ltrim($result, '/');
        $result = $this->match($result);
        if (stripos($result, 'ajax/1') > 1) {
            $result = $this->match(ltrim(str_replace('/ajax/1', '', $result), '/'));
            $result .= '/ajax/1';
        }
        return $result;
    }

    public function match($path, $direction = 1, $config = null)
    {
        if ($config == null) {
            $config = $this->route;
        }
        if ($direction = 1) {
            foreach ($config as $key => $conf) {
                if ($path == $key) {
                    $path = $conf;
                };
            }
        }

        return $path;
    }

    //出队列

    private function getArray()
    {
        $this->pathinfo = array_filter(explode('/', $this->pathinfo));
    }

    private function bindMvc()
    {
        if (empty($this->pathinfo)) {
            $empty = ture;
        }
        if (is_dir(ROOT . $this->pathinfo[0]) && !$empty) {
            $this->dfm['d'] = $this->pathinfo[0];
            $this->dequeue($this->pathinfo);
        } else {
            $this->dfm['d'] = 'home';
        }

        if (is_dir(ROOT . $this->dfm['d'] . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $this->pathinfo[0]) && !$empty) {
            $this->dfm['f'] = $this->pathinfo[0];
            $this->dequeue($this->pathinfo);
        } else {
            $this->dfm['f'] = 'index';
        }

        if (is_file(ROOT . $this->dfm['d'] . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $this->dfm['f'] . DIRECTORY_SEPARATOR . $this->pathinfo[0] . '.' . $this->dfm['f'] . 'Controller.php')) {
            $this->dfm['m'] = $this->pathinfo[0];
            $this->dequeue($this->pathinfo);


        } else {
            $this->dfm['m'] = 'index';
        }
        $this->param = $this->pathinfo;
    }
//    public function reload($str,$param=null){
//        $this->pathinfo = $str;
//        $this->getArray();
//        $this->bindMvc();
//        $G['get']=$this->dfm;
//        $G['get']['param']=$param;
//    }

    private function dequeue(&$array)
    {
        $array = array_reverse($array);
        array_pop($array);
        $array = array_reverse($array);
    }

    public function initParam()
    {
        $count = count($this->param);
        for ($i = 1; $i <= $count; $i += 2) {
            if (isset($this->param[$i])) {
                $tmp[$this->param[$i - 1]] = $this->param[$i];
            } elseif (isset($this->param[$i - 1])) {
                array_append($tmp, $this->param[$i - 1]);
            } else {
                $tmp = null;
            }
        }

        $this->param = $tmp;
    }

}

?>