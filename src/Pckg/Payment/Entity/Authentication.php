<?php

namespace Pckg\Payment\Entity;

/**
* 
*/
class Authentication
{
    /**
     * login
     *
     * @var string [32] Identificador habilitado para el consumo del   API, entregado por Place to Pay.
     */
    private $login;

    /**
     * tranKey
     *
     * @var string [40] Llave transaccional para el consumo del API SHA1(seed + tranKey)
     */
    private $tranKey;
    
    /**
     * seed
     *
     * @var string Semilla usada para el consumo del API en el proceso del hash por SHA1 del tranKey, ISO 8601.
     */
    private $seed;

    /**
     * additional
     *
     * @var \Attribute Datos adicionales a la estructura de autenticación
     */
    private $additional;

    
    function __construct(
        $login,
        $tranKey,
        $seed,
        $additional)
    {
        $this->login = $login;
        $this->tranKey = $tranKey;
        $this->seed = $seed;
        $this->additional = $additional;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getTrankey()
    {
        return $this->tranKey;
    }

    public function getSeed()
    {
        return $this->seed;
    }

    public function getAdditional()
    {
        return $this->additional;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setTrankey($tranKey)
    {
        $this->tranKey = $tranKey;
    }

    public function setSeed($seed)
    {
        $this->seed = $seed;
    }

    public function setAdditional($additional)
    {
        $this->additional = $additional;
    }



}