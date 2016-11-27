<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 10:55
 */
namespace Pckg\Test;

use Pckg\Payment\PTPayment;

require '../vendor/autoload.php';
require '../src/autoload.php';

$path_config = "./config.yml";

$pse = new PTPayment($path_config, "pse");
$bankList = $pse->dispatchRequest("getbanklist");



