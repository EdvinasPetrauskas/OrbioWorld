<?php

declare(strict_types=1);

namespace App\Services\Table;

class TableData
{
    /**
     * @param int $id
     */
    public function __construct(
        private int $id
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
