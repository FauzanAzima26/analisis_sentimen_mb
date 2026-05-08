<?php

namespace App\Http\Controllers;

use App\Models\ImportDataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TextProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('text_processing');
    }

    public function data()
    {
        $data = ImportDataset::select(
            'tweet',
            'clean_tweet'
        )->latest()->get();

        return response()->json($data);
    }

    public function reset()
    {
        ImportDataset::truncate();

        return response()->json([
            'message' => 'Semua data berhasil dihapus'
        ]);
    }

    public function processAll()
    {
        // =========================
        // 1. AMBIL DATA RAW
        // =========================
        $datasets = ImportDataset::whereNotNull('tweet')->get();

        if ($datasets->isEmpty()) {
            return response()->json([
                'message' => 'Data kosong'
            ]);
        }

        // =========================
        // 2. PREPROCESSING + SIMPAN
        // =========================
        foreach ($datasets as $data) {

            try {

                $response = Http::timeout(30)->post(
                    'http://127.0.0.1:5000/preprocess',
                    [
                        'text' => $data->tweet
                    ]
                );

                if ($response->failed()) {
                    continue;
                }

                $result = $response->json();

                $data->clean_tweet = $result['clean_text'] ?? null;

                $data->save();
            } catch (\Exception $e) {
                continue;
            }
        }

        // =========================
        // 3. AMBIL CLEAN TEXT
        // =========================
        $texts = ImportDataset::whereNotNull('clean_tweet')
            ->pluck('clean_tweet')
            ->toArray();

        if (empty($texts)) {
            return response()->json([
                'message' => 'Tidak ada data clean_tweet'
            ]);
        }

        // =========================
        // 4. HITUNG TF-IDF (FASTAPI)
        // =========================
        $tfidfResponse = Http::timeout(60)->post(
            'http://127.0.0.1:5000/tfidf',
            [
                'texts' => $texts
            ]
        );

        if ($tfidfResponse->failed()) {
            return response()->json([
                'message' => 'Gagal hitung TF-IDF'
            ]);
        }

        // =========================
        // 5. RETURN HASIL
        // =========================
        return response()->json([
            'message' => 'Processing selesai',
            'tfidf' => $tfidfResponse->json()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
