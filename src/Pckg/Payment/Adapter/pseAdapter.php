<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 13:13
 */

namespace Pckg\Payment\Adapter;


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

    public function authenticate($params)
    {
        // TODO: Implement authenticate() method.

        $this->pse->authenticate($params);
    }

    public function getBankList($params)
    {
        // TODO: Implement getBankList() method.
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