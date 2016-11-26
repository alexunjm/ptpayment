<?php

use Pckg\Payment\PSE;
use Pckg\Payment\pseAdapter;

class Test2 extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testTrueIsTrue2()
    {
        $pse = new pseAdapter(new PSE());
        $pse->pay('2629');
        $this->assertTrue(true);
    }
}
