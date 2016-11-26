<?php

namespace PlaceToPay\Entity;

/**
 *
 */
class TransactionInformation
{
    /**
     * transactionID
     *
     * @var int Identificador único de la transacción en PlacetoPay
     */
    private $transactionID;

    /**
     * sessionID
     *
     * @var string[32] Identificador único de la sesión en PlacetoPay
     */
    private $sessionID;

    /**
     * reference
     *
     * @var string[32] Referencia única de pago
     */
    private $reference;

    /**
     * requestDate
     *
     * @var string Fecha de solicitud o creación de la transacción acorde a ISO 8601
     */
    private $requestDate;

    /**
     * bankProcessDate
     *
     * @var string Fecha de procesamiento de la transacción acorde a ISO 8601
     */
    private $bankProcessDate;

    /**
     * onTest
     *
     * @var boolean Indicador de si la transacción es en modo de pruebas o no
     */
    private $onTest;

    /**
     * returnCode
     *
     * @var string[30] Código de respuesta de la transacción, uno de los siguientes: SUCCESS, FAIL_INVALIDTRAZABILITYCODE, etc
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
     * transactionState
     *
     * @var string[20] Información del estado de la transacción [OK, NOT_AUTHORIZED, PENDING, FAILED ]
     */
    private $transactionState;

    /**
     * responseCode
     *
     * @var int Estado de la operación en PlacetoPay
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
            $reference,
            $requestDate,
            $bankProcessDate,
            $onTest,
            $returnCode,
            $trazabilityCode,
            $transactionCycle,
            $transactionState,
            $responseCode,
            $responseReasonCode,
            $responseReasonText)
    {
        $this->transactionID = $transactionID;
        $this->sessionID = $sessionID;
        $this->reference = $reference;
        $this->requestDate = $requestDate;
        $this->bankProcessDate = $bankProcessDate;
        $this->onTest = $onTest;
        $this->returnCode = $returnCode;
        $this->trazabilityCode = $trazabilityCode;
        $this->transactionCycle = $transactionCycle;
        $this->transactionState = $transactionState;
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

    public function getReference()
    {
        return $this->reference;
    }

    public function getRequestDate()
    {
        return $this->requestDate;
    }

    public function getBankProcessDate()
    {
        return $this->bankProcessDate;
    }

    public function getOnTest()
    {
        return $this->onTest;
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

    public function getTransactionState()
    {
        return $this->transactionState;
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

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

    public function setBankProcessDate($bankProcessDate)
    {
        $this->bankProcessDate = $bankProcessDate;
    }

    public function setOnTest($onTest)
    {
        $this->onTest = $onTest;
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

    public function setTransactionState($transactionState)
    {
        $this->transactionState = $transactionState;
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