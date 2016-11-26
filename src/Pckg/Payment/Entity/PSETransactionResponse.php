<?php

namespace Pckg\Payment\Entity;

/**
* 
*/
class PSETransactionResponse
{
   /**
     * transactionID
     *
     * @var int Identificador único de la transacción en PlaceToPay
     */
    private $transactionID;

   /**
     * sessionID
     *
     * @var string[32] Identificador único de la sesión en PlacetoPay
     */
    private $sessionID;

  /**
    * returnCode
    *
    * @var string[30] Código de respuesta de la transacción, uno de los siguientes valores: SUCCESS, FAIL_ENTITYNOTEXISTSORDISABLED, etc
    */
   private $returnCode; 

  /**
    * trazabilityCode
    *
    * @var string[40] Código único de seguimiento para la operación dado por la red ACH
    */
   private $trazabilityCode;

/**
  * transactionCycle
  *
  * @var int Ciclo de compensación de la red
  */
 private $transactionCycle;

/**
  * bankCurrency
  *
  * @var string[3] Moneda aceptada por el banco acorde a ISO 4217
  */
 private $bankCurrency;

/**
  * bankFactor
  *
  * @var float Factor de conversión de la moneda
  */
 private $bankFactor; 

/**
  * bankURL
  *
  * @var string[255] URL a la cual remitir la solicitud para iniciar la interfaz del banco, sólo disponible cuando returnCode = SUCCESS
  */
 private $bankURL; 

/**
  * responseCode
  *
  * @var int Estado de la operación en PlacetoPay [ 0 = FAILED, 1 = APPROVED, 2 = DECLINED, 3 = PENDING ]
  */
 private $responseCode;

/**
  * responseReasonCode
  *
  * @var string[3] Código interno de respuesta de la operación en PlacetoPay
  */
 private $responseReasonCode; 

/**
  * responseReasonText
  *
  * @var string[255] Mensaje asociado con el código de respuesta de la operación en PlacetoPay 
  */
 private $responseReasonText;

    function __construct(
        $transactionID,
        $sessionID,
        $returnCode,
        $trazabilityCode,
        $transactionCycle,
        $bankCurrency,
        $bankFactor,
        $bankURL,
        $responseCode,
        $responseReasonCode,
        $responseReasonText)
    {
        $this->transactionID = $transactionID;
        $this->sessionID = $sessionID;
        $this->returnCode = $returnCode;
        $this->trazabilityCode = $trazabilityCode;
        $this->transactionCycle = $transactionCycle;
        $this->bankCurrency = $bankCurrency;
        $this->bankFactor = $bankFactor;
        $this->bankURL = $bankURL;
        $this->responseCode = $responseCode;
        $this->responseReasonCode = $responseReasonCode;
        $this->responseReasonText = $responseReasonText;
    }

    public function getTransactionID()
    {
      return $this->transactionID;
    }

    public function getSessionID()
    {
      return $this->sessionID;
    }

    public function getReturnCode()
    {
      return $this->returnCode;
    }

    public function getTrazabilityCode()
    {
      return $this->trazabilityCode;
    }

    public function getTransactionCycle()
    {
      return $this->transactionCycle;
    }

    public function getBankCurrency()
    {
      return $this->bankCurrency;
    }

    public function getBankFactor()
    {
      return $this->bankFactor;
    }

    public function getBankURL()
    {
      return $this->bankURL;
    }

    public function getResponseCode()
    {
      return $this->responseCode;
    }

    public function getResponseReasonCode()
    {
      return $this->responseReasonCode;
    }

    public function getResponseReasonText()
    {
      return $this->responseReasonText;
    }

    public function setTransactionID($transactionID)
    {
      $this->transactionID = $transactionID;
    }

    public function setSessionID($sessionID)
    {
      $this->sessionID = $sessionID;
    }

    public function setReturnCode($returnCode)
    {
      $this->returnCode = $returnCode;
    }

    public function setTrazabilityCode($trazabilityCode)
    {
      $this->trazabilityCode = $trazabilityCode;
    }

    public function setTransactionCycle($transactionCycle)
    {
      $this->transactionCycle = $transactionCycle;
    }

    public function setBankCurrency($bankCurrency)
    {
      $this->bankCurrency = $bankCurrency;
    }

    public function setBankFactor($bankFactor)
    {
      $this->bankFactor = $bankFactor;
    }

    public function setBankURL($bankURL)
    {
      $this->bankURL = $bankURL;
    }

    public function setResponseCode($responseCode)
    {
      $this->responseCode = $responseCode;
    }

    public function setResponseReasonCode($responseReasonCode)
    {
      $this->responseReasonCode = $responseReasonCode;
    }

    public function setResponseReasonText($responseReasonText)
    {
      $this->responseReasonText = $responseReasonText;
    }

}