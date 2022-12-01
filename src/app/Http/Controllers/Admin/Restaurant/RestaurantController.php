<?php

namespace App\Http\Controllers\Admin\Restaurant;

use App\Exceptions\Restaurant\RestaurantDuplicateModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\RestaurantCreateRequest;
use App\Repository\Restaurant\RestaurantRepository;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    /**
     * @param RestaurantRepository $restaurantRepository
     */
    public function __construct(
        private RestaurantRepository $restaurantRepository
    ) {
    }

    /**
     * @param RestaurantCreateRequest $request
     * @return JsonResponse
     * @throws RestaurantDuplicateModelException
     */
    public function createRestaurantWithTables(RestaurantCreateRequest $request): JsonResponse
    {
        $requestDTO = $request->getRequestDTO();

        $this->restaurantRepository->createWithTables($requestDTO);

        return $this->success(['true']);
    }
}
