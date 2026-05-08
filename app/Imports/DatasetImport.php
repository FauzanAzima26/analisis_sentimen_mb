<?php

namespace App\Imports;

use App\Models\ImportDataset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatasetImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ImportDataset([
            'tweet' => $row['tweet'] ?? null,
            'sentimen' => $row['sentimen'] ?? null,
        ]);
    }
}
