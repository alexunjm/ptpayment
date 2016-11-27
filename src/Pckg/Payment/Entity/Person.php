<?php

namespace Pckg\Payment\Entity;

/**
* 
*/
class Person
{
    /**
     * document
     *
     * @var string[12] Número de identificación de la persona
     **/
    private $document;
    
    /**
     * documentType
     *
     * @var string [3] Tipo de documento de identificación de la persona [CC, CE, TI, PPN].
     */
    private $documentType;

    /**
     * firstName
     *
     * @var string [60] Nombres
     **/
    var $firstName;

    /**
     * lastName
     *
     * @var string[60] Apellidos
     */
    private $lastName;
    
    /**
     * company
     *
     * @var string[60] Nombre de la compañía en la cual labora o representa
     */
    private $company;
    
    /**
     * emailAddress
     *
     * @var string[80] Correo electrónico
     */
    private $emailAddress;

    /**
     * address
     *
     * @var string[100] Dirección postal completa
     */
    private $address;

    /**
     * city
     *
     * @var string[50] Nombre de la ciudad coincidente con la dirección
     */
    private $city;

    /**
     * province
     *
     * @var string[50] Nombre de la provincia o departamento coincidente con la dirección
     */
    private $province;

    /**
     * country
     *
     * @var string[2] Código internacional del país que aplica a la
     */
    private $country;

    /**
     * phone
     *
     * @var string[30] Número de telefonía fija
     */
    private $phone;

    /**
     * mobile
     *
     * @var string[30] Número de telefonía móvil o celular
     */
    private $mobile;
    
    function __construct(
        $document,
        $documentType,
        $firstName,
        $lastName,
        $company,
        $emailAddress,
        $address,
        $city,
        $province,
        $country,
        $phone,
        $mobile)
    {
        $this->document = $document;
        $this->documentType = $documentType;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->company = $company;
        $this->emailAddress = $emailAddress;
        $this->address = $address;
        $this->city = $city;
        $this->province = $province;
        $this->country = $country;
        $this->phone = $phone;
        $this->mobile = $mobile;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function getDocumentType()
    {
        return $this->documentType;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }


}