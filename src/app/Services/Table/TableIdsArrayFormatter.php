<?php

declare(strict_types=1);

namespace App\Services\Table;

class TableIdsArrayFormatter
{
    /**
     * @param array $multiDimensionalArray
     * @return array
     */
    public function formatArray(array $multiDimensionalArray): array
    {
        $oneDimensionArray = [];
        foreach($multiDimensionalArray as $arrayValue) {
            $oneDimensionArray[] = $arrayValue->getId();
        }

        return array_values($oneDimensionArray);
    }
}
