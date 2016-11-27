<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 18:42
 */

namespace Pckg\Payment\Handler;


use Pckg\Payment\Entity\Authentication;

class Config
{
    private function __construct() {}
    public static $auth;

    public static function setParams($params)
    {
        $params_auth = $params["auth"];
        if ($params_auth)
        {
            self::$auth = new Authentication(
                        $params_auth["login"],
                        $params_auth["tranKey"],
                        "",
                        $params_auth["additional"]
                    );
        }
    }
}