<?php

namespace Database\Seeders;

use App\Models\ImportDataset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImportDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('data\dataset.csv');

        $file = fopen($path, 'r');

        // skip header
        fgetcsv($file, 10000, ";");

        $count = 0;

        while (($row = fgetcsv($file, 10000, ";")) !== false) {

            ImportDataset::create([

                'tweet' => $row[0] ?? null,

                'clean_tweet' => $row[1] ?? null,

                'sentiment_svm' => $row[2] ?? null,

                'sentiment_smote' => $row[3] ?? null,
            ]);

            $count++;
        }

        fclose($file);

        dd($count);
    }
}
