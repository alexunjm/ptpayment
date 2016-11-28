<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 10:55
 */
namespace Pckg\Test;

use Pckg\Payment\PTPayment;

//Autoload vendor
require '../vendor/autoload.php';

//Autoload Pckg
require '../src/autoload.php';

// Especificar ruta de archivo de configuración
$path_config = "./config.yml";


/*  
    Instanciar clase principal PTPayment 
    pse => handler (Podria extenderse la funcionalidad para otro handler ejemplo: paypal)
*/
$pse = new PTPayment($path_config, "pse");

//  Peticón para obtener listado de bancos
$bankList = $pse->dispatchRequest("getbanklist");

//  Filtrar entre el listado recibido
$bank = array_filter($bankList, function ($bankObj){
            return strtolower($bankObj->bankName) == strtolower("Banco Union Colombiano") ? true : false;
        });


//  Paramentros para la peticion de createTransaction
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
        "additionalData" => array(),
    );

//  Petición para crear una nueva CreateTransaction
$response = $pse->dispatchRequest("create-transaction", $params);

if($response->returnCode == "SUCCESS")
{
    //  Obtener Información de la Transaction creada
    var_dump($pse->dispatchRequest("transactionInfo", $transactionID=$response->transactionID));
}

