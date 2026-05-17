<?php

namespace App\Imports;

use App\Models\PredictionResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class DatasetImport implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    /**
     * Pengaturan khusus untuk file CSV
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
            'input_encoding' => 'UTF-8',
        ];
    }

    /**
     * Import setiap row
     */
    public function model(array $row)
    {
        $tweet = trim($row[array_key_first($row)]);

        return new PredictionResult([
            'tweet' => $tweet,
        ]);
    }
}
