<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 12:50
 */

namespace Pckg\Payment\Services;


class PSE
{
    public function __construct() {
        // Your Code here //
    }

    public function sendPayment($amount) {
        // Paying via Paypal //
        echo "Paying via PayPal: ". $amount;
    }

    public function authenticate($params)
    {

    }

    public function createTransaction()
    {

    }

    public function getBankList()
    {

    }

    public function getTransactionInformation()
    {

    }
}