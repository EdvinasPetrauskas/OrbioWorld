<?php

namespace App\Http\Controllers\Admin\Table;

use App\Exceptions\Table\TableDuplicateModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\TableCreateRequest;
use App\Repository\Table\TableRepository;
use Illuminate\Http\JsonResponse;

class TableController extends Controller
{
    /**
     * @param TableRepository $tableRepository
     */
    public function __construct(
        private TableRepository $tableRepository
    ) {
    }

    /**
     * @param TableCreateRequest $request
     * @return JsonResponse
     * @throws TableDuplicateModelException
     */
    public function createTable(TableCreateRequest $request): JsonResponse
    {
        $seats = $request->getSeats();

        $this->tableRepository->create($seats);

        return $this->success(['true']);
    }
}
