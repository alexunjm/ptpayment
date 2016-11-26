<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 10:55
 */
namespace Pckg\Test;

require '../vendor/autoload.php';
require '../src/autoload.php';

use Pckg\Payment\Adapter\pseAdapter;
use Pckg\Payment\Services\PSE;

$pse = new pseAdapter(new PSE());
$pse->pay('2629');

