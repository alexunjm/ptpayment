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
    public function createTransaction($params);
    public function getBankList();
    public function getTransactionInfo($params);
}