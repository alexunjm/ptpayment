<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 12:50
 */

namespace Pckg\Payment\Services;


use DateInterval;
use DateTime;
use Pckg\Payment\Entity\Authentication;
use Pckg\Payment\Entity\DB;
use Pckg\Payment\Entity\PSETransactionRequest;
use Pckg\Payment\Handler\Config;
use phpFastCache\CacheManager;
use phpFastCache\Core\phpFastCache;
use SoapClient;
use SoapFault;
use SQLite3;

class PSE
{
    private $authenticate;
    private $client;
    private $InstanceCache;

    public function __construct()
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 900);
        ini_set('default_socket_timeout', 15);
        $this->client = new SoapClient( Config::$endpoint, array(
                'trace'		=> true,
                'exceptions'=> true
        ));
        $this->InstanceCache = CacheManager::getInstance('files');
    }

    private function authenticate()
    {
        $this->authenticate = Config::$auth;
        $seed = date('c');
        $tranKey = $this->authenticate->getTranKey();
        $hashString = sha1($seed . $tranKey, false);
        $this->authenticate->setSeed($seed);
        $this->authenticate->setTranKey($hashString);
        if (!$this->authenticate->getAdditional()){
            $this->authenticate->setAdditional(array());
        }
    }

    public function getBankList()
    {
        $this->authenticate();
        $key = "bankList";
        $CachedString = $this->InstanceCache->getItem($key);
        if (is_null($CachedString->get())) {
            $data = $this->call_bank($CachedString);
        } else {
            if ($CachedString->isExpired()) {
                //  CACHE EXPIRO
                $data = $this->call_bank($CachedString);
            } else {
                //  LEER CACHE
                $data = unserialize($CachedString->get());
            }
        }

        return $data->getBankListResult->item;
    }

    private function call_bank($CachedString)
    {
        $result = $this->client->getBankList([ 'auth' => $this->authenticate->toArray() ]);
        if (is_soap_fault($result)) {
            trigger_error("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})", E_USER_ERROR);
        }

        $data = serialize($result);

        $CachedString->set( $data );
        $this->InstanceCache->save($CachedString);
        $fecha = new DateTime();
        $fecha->sub(new DateInterval('P1D'));
        $CachedString->expiresAt($fecha);

        return unserialize($data);
    }

    public function createTransaction($params)
    {
        $pseTransRequest = new PSETransactionRequest(
                $params["bankCode"],
                $params["bankInterface"],
                $params["description"],
                $params["language"],
                $params["currency"],
                $params["totalAmount"],
                $params["taxAmount"],
                $params["devolutionBase"],
                $params["tipAmount"],
                $params["payer"],
                $params["buyer"],
                $params["shipping"],
                $params["additionalData"]
            );

        $trankey = $this->authenticate->getTranKey();
        $seed = $this->authenticate->getSeed();
        $additional = $this->authenticate->getAdditional();

        $params = ["auth" => array(
                "login" => $this->authenticate->getLogin(),
                "tranKey" => $trankey,
                "seed" => $seed,
                "additional" => $additional,
        ),
                "transaction" => array(
                        'bankCode'		=> $pseTransRequest->getBankCode(),
                        'bankInterface'	=> $pseTransRequest->getBankInterface(),
                        'returnURL'		=> $pseTransRequest->getReturnURL(),
                        'reference'		=> $pseTransRequest->getReference(),
                        'description'	=> $pseTransRequest->getDescription(),
                        'language'		=> $pseTransRequest->getLanguage(),
                        'currency'		=> $pseTransRequest->getCurrency(),
                        'totalAmount'	=> $pseTransRequest->getTotalAmount(),
                        'taxAmount'		=> $pseTransRequest->getTaxAmount(),
                        'devolutionBase'=> $pseTransRequest->getDevolutionBase(),
                        'tipAmount'		=> $pseTransRequest->getTipAmount(),
                        'payer'			=> $pseTransRequest->getPayer(),
                        'ipAddress'		=> $pseTransRequest->getIpAddress(),
                        'userAgent'		=> $pseTransRequest->getUserAgent(),
                        'additionalData'=> $pseTransRequest->getAdditionalData()
                )
        ];


        try {
            $result = $this->client->createTransaction($params);
        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }

        $data = serialize($result);

        $data = unserialize($data);
        $response = $data->createTransactionResult;
        if ($response->returnCode == "SUCCESS")
            $this->persist($response);

        return $data->createTransactionResult;

    }

    private function persist($response)
    {
        $sql ="
                BEGIN TRANSACTION;
                    INSERT INTO `transaction` 
                        (returnCode,
                        bankURL,
                        trazabilityCode,
                        transactionID,
                        sessionID,
                        bankCurrency,
                        bankFactor,
                        responseCode,
                        responseReasonText) 
                        VALUES ('$response->returnCode',
                            '$response->bankURL',
                            '$response->trazabilityCode',
                            '$response->transactionID',
                            '$response->sessionID',
                            '$response->bankCurrency',
                            $response->bankFactor,
                            $response->responseCode,
                            '$response->responseReasonText.');
                COMMIT;
        ";
        $dbhandle = new DB();
        if(!$dbhandle){
            echo $dbhandle->lastErrorMsg();
            echo "pas";
        } else {
            $ret = $dbhandle->exec($sql);
            if(!$ret){
                echo $dbhandle->lastErrorMsg();
            } else {
                echo "Records created successfully\n";
            }
            $dbhandle->close();
        }
    }

    public function getTransactionInformation($params)
    {
        $trankey = $this->authenticate->getTranKey();
        $seed = $this->authenticate->getSeed();
        $additional = $this->authenticate->getAdditional();
        $params = ["auth" => array(
                                "login" => $this->authenticate->getLogin(),
                                "tranKey" => $trankey,
                                "seed" => $seed,
                                "additional" => $additional,
                            ),
                "transactionID" => 1443452912];


        try {
            $result = $this->client->getTransactionInformation($params);
        } catch (SoapFault $fault) {
            trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
        }
        $data = serialize($result);

        return unserialize($data)->getTransactionInformationResult;
    }
}