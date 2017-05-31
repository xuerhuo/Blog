<?php

namespace Cms\common;


class Kiwivm
{
    private $appid = null;
    private $appsecret = null;
    private $site = null;
    private $apiurl = array(
        'restart' => '{site}v1/restart?veid={appid}&api_key={appsecret}'
    );
    public function __construct($appid, $appsecret, $site)
    {
        $this->appid = $appid;
        $this->appsecret = $appsecret;
        $this->site = $site;
    }

    public function restart()
    {
        return $this->get($this->apiurl['restart']);
    }

    public function get($url)
    {
        $url = str_replace("{site}", $this->site, $url);
        $url = str_replace("{appid}", $this->appid, $url);
        $url = str_replace("{appsecret}", $this->appsecret, $url);
        return json_decode(file_get_contents($url));
    }
}

?>