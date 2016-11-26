<?php

namespace Pckg\Payment\Entity;


class Attribute
{
    /**
     * name
     *
     * @var string [30] Código para referenciar el atributo
     */
    private $name;

    /**
     * value
     *
     * @var string [128] Valor que asume el atributo
     */
    private $value;

    function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}