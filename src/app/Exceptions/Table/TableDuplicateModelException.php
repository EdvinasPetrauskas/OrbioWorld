<?php

namespace App\Exceptions\Table;

use Exception;
use Illuminate\Http\JsonResponse;

class TableDuplicateModelException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => 'Table already exists with provided seats'
            ]
        ], 409);
    }
}
