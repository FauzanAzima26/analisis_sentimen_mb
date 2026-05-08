<?php

namespace App\Http\Controllers;

use App\Models\ImportDataset;
use Illuminate\Http\Request;

class ImportDatasetController extends Controller
{
    public function index()
    {
        return view('import_dataset');
    }

    public function data()
    {
        $data = ImportDataset::latest()->get();

        return response()->json($data);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('file'), 'r');

        // Skip header CSV
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {

            ImportDataset::create([
                'tweet' => $row[0],
                'sentimen' => $row[1] ?? null
            ]);
        }

        fclose($file);

        return response()->json([
            'success' => true,
            'message' => 'Dataset berhasil diimport'
        ]);
    }
}
