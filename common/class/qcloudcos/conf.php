<?php

namespace qcloudcos;

class Conf
{
    // Cos php sdk version number.
    const VERSION = 'v4.2.3';
    const API_COSAPI_END_POINT = 'http://region.file.myqcloud.com/files/v2/';

    // Please refer to http://console.qcloud.com/cos to fetch your app_id, secret_id and secret_key.
    const APP_ID = '1252064563';
    const SECRET_ID = 'AKID3uXu0q8koiNn22HIYYIlyvb2D7k7F3eB';
    const SECRET_KEY = 'PZT7UbR1KN9futb3E9nBJSLyLRHq9BxS';
    /**
     * Get the User-Agent string to send to COS server.
     */
    public static function getUserAgent()
    {
        return 'cos-php-sdk-' . self::VERSION;
    }
}
