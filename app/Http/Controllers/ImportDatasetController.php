<?php

namespace App\Http\Controllers;

use App\Imports\DatasetImport;
use App\Models\PredictionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
            PredictionResult::latest()->get()
        );
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        // AMBIL FILE
        $file = $request->file('file');

        // CEK EXTENSION
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, ['csv', 'xlsx', 'xls'])) {
            return response()->json([
                'success' => false,
                'message' => 'Format file tidak didukung'
            ], 422);
        }

        try {

            Excel::import(
                new DatasetImport,
                $file
            );

            return response()->json([
                'success' => true,
                'message' => 'Dataset berhasil diimport'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Import gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function predictSingle(Request $request)
    {
        $request->validate([
            'tweet' => 'required|string|max:280'
        ]);

        $tweet = $request->tweet;

        // CALL FASTAPI
        $response = Http::post('http://127.0.0.1:5000/predict', [
            'text' => $tweet
        ]);

        if (!$response->successful()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghubungi model API'
            ], 500);
        }

        $result = $response->json();

        return response()->json([
            'status' => 'success',
            'tweet' => $tweet,
            'clean_text' => $result['clean_text'],
            'svm' => $result['svm'],
            'smote' => $result['svm_dan_smote']
        ]);
    }
}
