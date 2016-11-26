<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 13:12
 */

namespace Pckg\Payment\Adapter;


interface paymentAdapter
{
    public function pay($amount);
    public function authenticate($params);
    public function createTransaction($params);
    public function getBankList($params);
    public function getTransactionInfo($params);
}