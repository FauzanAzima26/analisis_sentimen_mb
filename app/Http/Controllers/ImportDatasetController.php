<?php

namespace App\Http\Controllers;

use App\Imports\DatasetImport;
use App\Models\ImportDataset;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportDatasetController extends Controller
{
    public function index()
    {
        return view('import_dataset');
    }

    public function data()
    {
        return response()->json(
            ImportDataset::latest()->get()
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);

        Excel::import(
            new DatasetImport,
            $request->file('file')
        );

        return response()->json([
            'success' => true,
            'message' => 'Dataset berhasil diimport'
        ]);
    }
}
