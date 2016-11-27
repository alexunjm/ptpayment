<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 26/11/2016
 * Time: 16:52
 */

namespace Pckg\Payment;


use Pckg\Payment\Handler\Config;
use Pckg\Payment\Handler\Dispatcher;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class PTPayment
{

    private $dispatcher;
    private $path_config;
    private $config;

    public function __construct($path_config, $handler)
    {
        $this->path_config = $path_config;
        $this->initConfig();
        $this->dispatcher = new Dispatcher($handler);
    }

    public function dispatchRequest($request, $params=null){
        return $this->dispatcher->dispatch($request, $params);
    }

    private function initConfig()
    {
        $this->parseYAML();
        Config::setParams($this->config);
    }

    private function parseYAML()
    {
        try {
            $this->config = Yaml::parse(file_get_contents($this->path_config));
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }
}