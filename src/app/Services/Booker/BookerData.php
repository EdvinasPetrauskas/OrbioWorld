<?php

declare(strict_types=1);

namespace App\Services\Booker;

class BookerData
{
    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $phone
     */
    public function __construct(
        private string $name,
        private string $surname,
        private string $email,
        private string $phone
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
