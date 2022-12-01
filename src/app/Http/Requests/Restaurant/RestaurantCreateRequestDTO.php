<?php

declare(strict_types=1);

namespace App\Http\Requests\Restaurant;

class RestaurantCreateRequestDTO
{
    /**
     * @param string $name
     * @param integer[] $tables
     */
    public function __construct(
        private string $name,
        private array $tables
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
     * @return integer[]
     */
    public function getTables(): array
    {
        return $this->tables;
    }
}
