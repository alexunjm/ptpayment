<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 18:42
 */

namespace Pckg\Payment\Handler;


use Pckg\Payment\Entity\Authentication;
use phpFastCache\CacheManager;

class Config
{
    private function __construct()
    {
    }

    public static $auth;
    public static $endpoint;

    public static function setParams($params)
    {
        $params_auth = $params["auth"];
        if ($params_auth) {
            self::$auth = new Authentication(
                    $params_auth["login"],
                    $params_auth["tranKey"],
                    "",
                    $params_auth["additional"]
            );
            self::$endpoint = $params_auth["endpoint"];
        }

        $param_cache = $params["cache"];
        if ($param_cache["path"]) {
            $path = $param_cache["path"];
        } else {
            $path = sys_get_temp_dir();
        }
        // Setup File Path on your config files
        CacheManager::setDefaultConfig(array(
                "path" => $path,
        ));

    }
}