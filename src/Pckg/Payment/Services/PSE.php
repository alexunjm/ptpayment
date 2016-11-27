<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 12:50
 */

namespace Pckg\Payment\Services;


use Pckg\Payment\Entity\Authentication;
use Pckg\Payment\Handler\Config;

class PSE
{
    private $authenticate;

    public function __construct() {
        // Your Code here //
    }

    public function sendPayment($amount) {
        // Paying via Paypal //
        echo "Paying via PayPal: ". $amount;
    }

    private function authenticate()
    {
        $this->authenticate = Config::$auth;
        $seed = date('c');
        $tranKey = $this->authenticate->getTranKey();
        $hashString = sha1( $seed . $tranKey , false );
        $this->authenticate->setSeed($seed);
        $this->authenticate->setTranKey($hashString);
        var_dump($this->authenticate);
    }

    public function createTransaction()
    {

    }

    public function getBankList()
    {
        $this->authenticate();
    }

    public function getTransactionInformation()
    {

    }
}