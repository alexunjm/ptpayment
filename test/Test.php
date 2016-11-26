<?php

namespace Pckg\Test;

use Pckg\Payment\PSE;
use Pckg\Payment\pseAdapter;

class Test extends \PHPUnit_Framework_TestCase
{
    public function paymentTest()
    {
        // Client Code
        $pse = new pseAdapter(new PSE());
        $pse->pay('2629');
        $this->assertTrue(true);
    }
}
