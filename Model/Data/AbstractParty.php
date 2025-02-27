<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class AbstractParty
{
    /**
     * Company name of the party
     *
     * @var string|null
     */
    public ?string $companyName;

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
     * @var Phone
     */
    public Phone $phone;

    /**
     * Language code used by the party
     *
     * @var string
     */
    public string $languageCode;

    /**
     * Get the company name of the party
     *
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * Set the company name of the party
     *
     * @param string|null $companyName
     * @return void
     */
    public function setCompanyName(?string $companyName): void
    {
        $this->companyName = $companyName;
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
     * @return void
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
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
     * @return void
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
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
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get the phone details of the party
     *
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * Set the phone details of the party
     *
     * @param Phone $phone
     * @return void
     */
    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
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
     * @return void
     */
    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }
}
