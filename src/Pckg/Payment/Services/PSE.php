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
use Pckg\Payment\Handler\Config;
use phpFastCache\CacheManager;
use phpFastCache\Core\phpFastCache;
use SoapClient;
use SoapFault;

class PSE
{
    private $authenticate;
    private static $client;
    private $InstanceCache;

    public function __construct()
    {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 900);
        ini_set('default_socket_timeout', 15);
        self::$client = new SoapClient( Config::$endpoint, array(
                'trace'		=> true,
                'exceptions'=> false
        ));
        $this->InstanceCache = CacheManager::getInstance('files');
    }

    public function sendPayment($amount)
    {
        // Paying via Paypal //
        echo "Paying via PayPal: " . $amount;
    }

    private function authenticate()
    {
        $this->authenticate = Config::$auth;
        $seed = date('c');
        $tranKey = $this->authenticate->getTranKey();
        $hashString = sha1($seed . $tranKey, false);
        $this->authenticate->setSeed($seed);
        $this->authenticate->setTranKey($hashString);
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
        $result = self::$client->getBankList([ 'auth' => $this->authenticate->toArray() ]);
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
        $this->authenticate();
        $result = self::$client->createTransaction([
                'auth'          => $this->authenticate->toArray(),
                'transaction'   => $params
        ]);
        if (is_soap_fault($result)) {
            trigger_error("SOAP Fault: (faultcode: {$result->faultcode}, faultstring: {$result->faultstring})", E_USER_ERROR);
        }

    }

    public function getTransactionInformation()
    {

    }
}