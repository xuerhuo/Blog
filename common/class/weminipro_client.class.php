<?php

/**
 * Created by PhpStorm.
 * User: erhuo
 * Date: 2017/7/1
 * Time: 20:23
 */

namespace Cms\common;
class weminipro_client
{
    private $api_url = array(
        'code_to_session' => 'https://api.weixin.qq.com/sns/jscode2session?appid={appid}&secret={secret}&js_code={code}&grant_type=authorization_code'

    );
    private $appid = '';
    private $secret = '';
    private $code = '';
    private $openid = '';
    private $sesion_key = '';

    public function __construct($appid, $secret)
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    public function getOpenid($code)
    {
        $this->code = $code;
        $url = $this->formaturl('code_to_session', array('code' => $code));
        $result = json_decode($this->get($url), 1);
        $this->sesion_key = $result['session_key'];
        $this->openid = $result['openid'];
        return $result;
    }

    public function formaturl($urlname, $args)
    {
        $result = $this->api_url[$urlname];
        if ($urlname == 'code_to_session') {
            $result = str_replace('{appid}', $this->appid, $result);
            $result = str_replace('{secret}', $this->secret, $result);
            $result = str_replace('{code}', $args['code'], $result);
        }
        return $result;
    }

    public function get($url)
    {
        return file_get_contents($url);
    }
}