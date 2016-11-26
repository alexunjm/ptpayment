<?php

namespace Pckg\Payment\Entity;

/**
* 
*/
class Bank
{
	/**
	 * bankCode
	 *
	 * @var string[4] Código de la entidad financiera
	 */
	private $bankCode;

	/**
	  * bankName
	  *
	  * @var string[60] Nombre de la entidad financiera
	  */
	 private $bankName;
	
	function __construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
	}

	public function getBankCode()
	{
		return $this->bankCode;
	}

	public function getBankName()
	{
		return $this->bankName;
	}

	public function setBankCode($bankCode)
	{
		$this->bankCode = $bankCode;
	}

	public function setBankName($bankName)
	{
		$this->bankName = $bankName;
	}
}