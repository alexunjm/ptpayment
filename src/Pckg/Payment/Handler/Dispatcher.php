<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 16:56
 */

namespace Pckg\Payment\Handler;


use Pckg\Payment\Adapter\pseAdapter;
use Pckg\Payment\Services\PSE;
use Pckg\Payment\Validate\Validator;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class Dispatcher
{
    private $pseAdapter;
    private $errors;

    /**
     * Dispatcher constructor.
     */
    public function __construct($handler)
    {
        if (strcasecmp($handler, "pse") == 0) {
            $this->pseAdapter = new pseAdapter(new PSE());
            $this->errors["status"] = "error";
        }
    }

    public function dispatch($request, $params)
    {
        if (strcasecmp($request, "getbanklist") == 0) {
            return $this->pseAdapter->getBankList();
        }

        if (strcasecmp($request, "create-transaction") == 0) {
            if (!$params)
                return null;

            $response_valid = Validator::initValid($params);

            if ($response_valid["status"] == "error")
                return $response_valid;

            return $this->pseAdapter->createTransaction($response_valid["params"]);
        }

        if (strcasecmp($request, "transactionInfo") == 0) {
            if (!$params)
                return null;

            return $this->pseAdapter->getTransactionInfo($params);
        }
    }

}