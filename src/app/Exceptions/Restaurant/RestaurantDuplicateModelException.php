<?php

namespace App\Exceptions\Restaurant;

use Exception;
use Illuminate\Http\JsonResponse;

class RestaurantDuplicateModelException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => 'Restaurant already exists with provided name'
            ]
        ], 409);
    }
}
