<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Api\Data;

interface AddressInterface
{
    /**
     * Get address name
     *
     * @return string
     */
    public function getName();

    /**
     * Set address name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany();

    /**
     * Set company
     *
     * @param string $company
     * @return $this
     */
    public function setCompany($company);

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet();

    /**
     * Set street
     *
     * @param string $street
     * @return $this
     */
    public function setStreet($street);

    /**
     * Get city
     *
     * @return string
     */
    public function getCity();

    /**
     * Set city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city);

    /**
     * Get postal code
     *
     * @return string
     */
    public function getPostalCode();

    /**
     * Set postal code
     *
     * @param string $postalCode
     * @return $this
     */
    public function setPostalCode($postalCode);

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * Get phone
     *
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     *
     * @param string|null $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * Get email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string|null $email
     * @return $this
     */
    public function setEmail($email);
}
