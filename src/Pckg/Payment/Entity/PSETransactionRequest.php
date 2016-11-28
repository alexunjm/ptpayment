<?php

namespace Pckg\Payment\Entity;

use Pckg\Payment\Handler\Config;
use Pckg\Payment\Person;
use Pckg\Payment\Attribute;

/**
 *
 */
class PSETransactionRequest
{
    /**
     * bankCode
     *
     * @var string[4] Código de la entidad financiera con la cual realizar la transacción
     */
    private $bankCode;

    /**
     * bankInterface
     *
     * @var string[1] Tipo de interfaz del banco a desplegar [0 =    PERSONAS, 1 = EMPRESAS]
     */
    private $bankInterface;

    /**
     * returnURL
     *
     * @var string[255] URL de retorno especificada para la entidad financiera
     */
    private $returnURL;

    /**
     * reference
     *
     * @var string[32] Referencia única de pago
     */
    private $reference;

    /**
     * description
     *
     * @var string[255] Descripción del pago
     */
    private $description;

    /**
     * language
     *
     * @var string[2] Idioma esperado para las transacciones acorde a ISO 631-1, mayúscula sostenida
     */
    private $language;

    /**
     * currency
     *
     * @var string[3] Moneda a usar para el recaudo acorde a ISO 4217
     */
    private $currency;

    /**
     * totalAmount
     *
     * @var double Valor total a recaudar
     */
    private $totalAmount;

    /**
     * taxAmount
     *
     * @var double Discriminación del impuesto aplicado
     */
    private $taxAmount;

    /**
     * devolutionBase
     *
     * @var double Base de devolución para el impuesto
     */
    private $devolutionBase;

    /**
     * tipAmount
     *
     * @var double Propina u otros valores exentos de impuesto (tasa aeroportuaria) y que deben agregarse al    valor total a pagar
     */
    private $tipAmount;


    /**
     * payer
     *
     * @var \Person Información del pagador
     */
    private $payer;

    /**
     * buyer
     *
     * @var Person Información del comprador
     */
    private $buyer;

    /**
     * shipping
     *
     * @var \Person Información del receptor
     */
    private $shipping;

    /**
     * ipAddress
     *
     * @var string[15] Dirección IP desde la cual realiza la transacción el pagador
     */
    private $ipAddress;

    /**
     * userAgent
     *
     * @var string[255] Agente de navegación utilizado por el    pagador
     */
    private $userAgent;


    /**
     * additionalData
     *
     * @var \Attribute[] Datos adicionales para ser almacenados con la transacción
     */
    private $additionalData;

    function __construct(
			$bankCode,
			$bankInterface,
			$description,
			$language,
			$currency,
			$totalAmount,
			$taxAmount,
			$devolutionBase,
			$tipAmount,
			$payer,
			$buyer,
			$shipping,
			$additionalData)
    {
        $this->bankCode = $bankCode;
        $this->bankInterface = $bankInterface;
        $this->returnURL = Config::$returnURL;
        $this->reference = uniqid("pay_");
        $this->description = $description;
        $this->language = $language;
        $this->currency = $currency;
        $this->totalAmount = $totalAmount;
        $this->taxAmount = $taxAmount;
        $this->devolutionBase = $devolutionBase;
        $this->tipAmount = $tipAmount;
        $this->payer = $payer;
        $this->buyer = $buyer;
        $this->shipping = $shipping;
        $this->ipAddress = $this->getIp();
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->additionalData = $additionalData;
    }

    private function getIp() {

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        return $ipAddress;
    }

    public function toArray()
    {
		return [
			'bankCode'		=> $this->bankCode,
			'bankInterface'	=> $this->bankInterface,
			'returnURL'		=> $this->returnURL,
			'reference'		=> $this->reference,
			'description'	=> $this->description,
			'language'		=> $this->language,
			'currency'		=> $this->currency,
			'totalAmount'	=> $this->totalAmount,
			'taxAmount'		=> $this->taxAmount,
			'devolutionBase'=> $this->devolutionBase,
			'tipAmount'		=> $this->tipAmount,
			'payer'			=> $this->payer,
			'buyer'			=> $this->buyer,
			'shipping'		=> $this->shipping,
			'ipAddress'		=> $this->ipAddress,
			'userAgent'		=> $this->userAgent,
			'additionalData'=> $this->additionalData
		];
    }

    public function getBankCode()
    {
        return $this->bankCode;
    }

    public function getBankInterface()
    {
        return $this->bankInterface;
    }

    public function getReturnURL()
    {
        return $this->returnURL;
    }

    public function getReference()
    {
        return $this->reference;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

    public function getDevolutionBase()
    {
        return $this->devolutionBase;
    }

    public function getTipAmount()
    {
        return $this->tipAmount;
    }

    public function getPayer()
    {
        return $this->payer;
    }

    public function getBuyer()
    {
        return $this->buyer;
    }

    public function getShipping()
    {
        return $this->shipping;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function getAdditionalData()
    {
        return $this->additionalData;
    }

    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

    public function setBankInterface($bankInterface)
    {
        $this->bankInterface = $bankInterface;
    }

    public function setReturnURL($returnURL)
    {
        $this->returnURL = $returnURL;
    }

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    public function setDevolutionBase($devolutionBase)
    {
        $this->devolutionBase = $devolutionBase;
    }

    public function setTipAmount($tipAmount)
    {
        $this->tipAmount = $tipAmount;
    }

    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
    }

    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }

}