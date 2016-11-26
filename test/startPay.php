<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 13:35
 */

namespace Pckg\Test;

class startPay extends \PHPUnit_Framework_TestCase
{

    public function test()
    {
        $pse = new \Pckg\Payment\pseAdapter(new PSE());
        $this->assertTrue(true);
    }

}
