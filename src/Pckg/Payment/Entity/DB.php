<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 27/11/2016
 * Time: 21:44
 */

namespace Pckg\Payment\Entity;


use Pckg\Payment\Handler\Config;

class DB extends \SQLite3
{
    function __construct()
    {
        $this->open(Config::$database);
    }

}