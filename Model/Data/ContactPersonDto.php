<?php

declare(strict_types=1);

namespace Smartcore\InPostInternational\Model\Data;

class ContactPersonDto extends AbstractDto
{
    /**
     * @var string
     */
    public string $firstName;

    /**
     * @var string
     */
    public string $lastName;

    /**
     * @var string
     */
    public string $email;

    /**
     * @var PhoneDto
     */
    public PhoneDto $phone;

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set first name
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set last name
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get phone
     *
     * @return PhoneDto
     */
    public function getPhone(): PhoneDto
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param PhoneDto $phone
     * @return self
     */
    public function setPhone(PhoneDto $phone): self
    {
        $this->phone = $phone;
        return $this;
    }
}
