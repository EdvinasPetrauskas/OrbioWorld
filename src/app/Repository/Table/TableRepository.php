<?php

namespace App\Repository\Table;

use App\Exceptions\Table\TableDuplicateModelException;
use App\Models\Table;

class TableRepository
{
    /**
     * @param int $id
     * @return Table
     */
    public function get(int $id): Table
    {
        return Table::find($id);
    }

    /**
     * @param int $seats
     * @return void
     * @throws TableDuplicateModelException
     */
    public function create(int $seats): void
    {
        if (Table::where('seats', $seats)->exists()) {
            throw new TableDuplicateModelException();
        }

        $table = new Table([
            'seats' => $seats
        ]);

        $table->save();
    }
}
