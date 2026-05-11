<?php

namespace App\Http\Controllers;

use App\Models\PredictionResult;
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
        $data = PredictionResult::select(
            'tweet',
            'clean_tweet'
        )->latest()->get();

        return response()->json($data);
    }

    public function reset()
    {
        PredictionResult::truncate();

        return response()->json([
            'message' => 'Data prediksi berhasil direset'
        ]);
    }

    public function processAll()
    {
        // =========================
        // 1. AMBIL DATA RAW
        // =========================
        $datasets = PredictionResult::whereNotNull('tweet')->get();

        if ($datasets->isEmpty()) {

            return response()->json([
                'message' => 'Data kosong'
            ]);
        }

        // =========================
        // 2. PREPROCESSING
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

                $data->clean_tweet =
                    $result['clean_text'] ?? null;

                $data->save();
            } catch (\Exception $e) {

                continue;
            }
        }

        // =========================
        // 3. AMBIL CLEAN TEXT
        // =========================
        $cleanDatasets = PredictionResult::whereNotNull('clean_tweet')->get();

        if ($cleanDatasets->isEmpty()) {

            return response()->json([
                'message' => 'Tidak ada clean_tweet'
            ]);
        }

        $texts = $cleanDatasets
            ->pluck('clean_tweet')
            ->toArray();

        // =========================
        // 4. TF-IDF
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

        $tfidfData =
            $tfidfResponse->json()['data'] ?? [];

        // =========================
        // 6. PREDICTION
        // =========================
        foreach ($cleanDatasets as $data) {

            try {

                $predictionResponse = Http::timeout(30)->post(
                    'http://127.0.0.1:5000/predict',
                    [
                        'text' => $data->clean_tweet
                    ]
                );

                if ($predictionResponse->failed()) {
                    continue;
                }

                $predictionResult =
                    $predictionResponse->json();

                // =========================
                // SIMPAN HASIL PREDIKSI
                // =========================
                $data->sentimen_svm =
                    $predictionResult['svm'] ?? null;

                $data->sentimen_smote =
                    $predictionResult['svm_dan_smote'] ?? null;

                $data->save();
            } catch (\Exception $e) {

                continue;
            }
        }

        // =========================
        // 7. RETURN
        // =========================
        return response()->json([
            'message' => 'Preprocessing, TF-IDF, dan Prediction berhasil',
            'total_data' => $datasets->count(),
            'tfidf_saved' => count($tfidfData)
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
