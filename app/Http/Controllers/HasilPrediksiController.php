<?php

namespace App\Http\Controllers;

use App\Models\PredictionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HasilPrediksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('hasil_prediksi');
    }

    public function data()
    {
        $datasets = PredictionResult::all();

        return response()->json([
            'data' => $datasets
        ]);
    }

    public function processPrediction()
    {
        $datasets = PredictionResult::whereNotNull('clean_tweet')->get();

        foreach ($datasets as $data) {

            try {

                $response = Http::post(
                    'http://127.0.0.1:5000/predict',
                    [
                        'text' => $data->clean_tweet
                    ]
                );

                if ($response->failed()) {
                    continue;
                }
                $result = $response->json();

                $data->sentimen_svm =
                    $result['svm_prediction'] ?? null;

                $data->sentimen_smote =
                    $result['smote_prediction'] ?? null;

                $data->save();
            } catch (\Exception $e) {

                continue;
            }
        }

        return response()->json([
            'message' => 'Prediction selesai'
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
