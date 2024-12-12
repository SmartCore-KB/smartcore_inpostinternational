<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class AbstractPartyDto extends AbstractDto
{
    /**
     * Company name of the party
     *
     * @var string
     */
    public string $companyName;

    /**
     * First name of the party
     *
     * @var string
     */
    public string $firstName;

    /**
     * Last name of the party
     *
     * @var string
     */
    public string $lastName;

    /**
     * Email address of the party
     *
     * @var string
     */
    public string $email;

    /**
     * Phone details of the party
     *
     * @var PhoneDto
     */
    public PhoneDto $phone;

    /**
     * Language code used by the party
     *
     * @var string
     */
    public string $languageCode;

    /**
     * Get the company name of the party
     *
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * Set the company name of the party
     *
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * Get the first name of the party
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set the first name of the party
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get the last name of the party
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set the last name of the party
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get the email address of the party
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the email address of the party
     *
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the phone details of the party
     *
     * @return PhoneDto
     */
    public function getPhone(): PhoneDto
    {
        return $this->phone;
    }

    /**
     * Set the phone details of the party
     *
     * @param PhoneDto $phone
     * @return $this
     */
    public function setPhone(PhoneDto $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get the language code used by the party
     *
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    /**
     * Set the language code used by the party
     *
     * @param string $languageCode
     * @return $this
     */
    public function setLanguageCode(string $languageCode): static
    {
        $this->languageCode = $languageCode;
        return $this;
    }
}
