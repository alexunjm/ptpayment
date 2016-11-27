<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 13:13
 */

namespace Pckg\Payment\Adapter;


use Pckg\Payment\Services\PSE;

class pseAdapter implements paymentAdapter
{
    private $pse;

    /**
     * pseAdapter constructor.
     * @param PSE $pse
     */
    public function __construct(PSE $pse)
    {
        $this->pse = $pse;
    }

    /**
     * Monto a pagar
     * @param $amount
     */
    public function pay($amount)
    {
        $this->pse->sendPayment($amount);
    }

    public function getBankList()
    {
        // TODO: Implement getBankList() method.
        $this->pse->getBankList();
    }

    public function createTransaction($params)
    {
        // TODO: Implement createTransaction() method.
    }

    public function getTransactionInfo($params)
    {
        // TODO: Implement getTransactionInfo() method.
    }
}