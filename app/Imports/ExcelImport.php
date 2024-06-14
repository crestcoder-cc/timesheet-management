<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    protected $currentRow = 0;

    public function model(array $row)
    {

        $this->currentRow++;

        // Check if it's the second row
        if ($this->currentRow === 2) {
            // Dump the row for debugging
            dd($row);
        }
        return null;
    }
}
