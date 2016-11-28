<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 10:55
 */
namespace Pckg\Test;

use Pckg\Payment\PTPayment;

require '../vendor/autoload.php';
require '../src/autoload.php';

$path_config = "./config.yml";

$pse = new PTPayment($path_config, "pse");
$bankList = $pse->dispatchRequest("getbanklist");

$bank = array_filter($bankList, function ($bankObj){
            return strtolower($bankObj->bankName) == strtolower("Banco Union Colombiano") ? true : false;
        });

$key = key($bank);
$bank = $bank[$key];

$person = array(
        "document" => "5044928468",
        "documentType" => "CC",
        "firstName" => "Juana",
        "lastName" => "López",
        "company" => "ARC",
        "emailAddress" => "juana@arc.com",
        "address" => "Carrera 51",
        "city" => "Medellín",
        "province" => "Antioquia",
        "country" => "CO",        
        "phone" => "4445380",
        "mobile" => "3173369032",
    );

$params = array(
        "bankCode" => $bank->bankCode,
        "bankInterface" => 1,
        "returnURL" => "http://www.google.com",
        "reference" => uniqid("pay_"),
        "description" => "Pago",
        "language" => "ES",
        "currency" => "COP",
        "totalAmount" => 100,
        "taxAmount" => 1,
        "devolutionBase" => 1,
        "tipAmount" => 10,
        "payer" => $person,
        "buyer" => $person,
        "shipping" => $person,
        "ipAddress" => "127.0.0.1",
        "userAgent" => "chrome",
        "additionalData" => array(),
    );

$response = $pse->dispatchRequest("create-transaction", $params);

if($response->returnCode == "SUCCESS")
{
    var_dump($pse->dispatchRequest("transactionInfo", $transactionID=$response->transactionID));
}

