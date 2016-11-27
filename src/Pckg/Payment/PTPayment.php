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
        $this->dispatcher = new Dispatcher($handler);
        $this->path_config = $path_config;
        $this->initConfig();
    }

    public function dispatchRequest($request){
        $this->dispatcher->dispatch($request);
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
            var_dump($this->config);

        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
        }
    }
}