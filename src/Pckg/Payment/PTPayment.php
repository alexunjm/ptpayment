<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 16:52
 */

namespace Pckg\Payment;


use Pckg\Payment\Handler\Dispatcher;

class PTPayment
{

    private $dispatcher;
    private $config;
    private $handler;

    /**
     * PTPayment constructor.
     * @param $dispatcher
     */
    public function __construct($config, $handler)
    {
        $this->handler = $handler;
        $this->dispatcher = new Dispatcher();
        $this->config = $config;
        $this->initConfig();
    }

    public function dispatchRequest($request){
        $this->dispatcher->dispatch($request);
    }

    public function initConfig()
    {
        
    }
}