<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 27/11/2016
 * Time: 18:43
 */

namespace Pckg\Payment\Entity;


use Pckg\Payment\Handler\Config;
use SQLite3;

class DB extends SQLite3
{
    function __construct()
    {
        $this->open(Config::$database);
    }
}