<?php

namespace App\Http\Controllers;

use App\Models\PredictionResult;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TOTAL DATA
        $total = PredictionResult::count();

        // =========================
        // SVM
        // =========================
        $svm_positif = PredictionResult::where('sentimen_svm', 'positif')->count();
        $svm_negatif = PredictionResult::where('sentimen_svm', 'negatif')->count();
        $svm_netral  = PredictionResult::where('sentimen_svm', 'netral')->count();

        // =========================
        // SMOTE
        // =========================
        $smote_positif = PredictionResult::where('sentimen_smote', 'positif')->count();
        $smote_negatif = PredictionResult::where('sentimen_smote', 'negatif')->count();
        $smote_netral  = PredictionResult::where('sentimen_smote', 'netral')->count();

        // =========================
        // SVM METRICS
        // =========================
        $svmMetrics = [
            'accuracy' => 82.68,
            'precision' => 84,
            'recall' => 80,
            'f1_score' => 82
        ];

        // =========================
        // SVM + SMOTE METRICS
        // =========================
        $smoteMetrics = [
            'accuracy' => 84.51,
            'precision' => 85,
            'recall' => 83,
            'f1_score' => 84
        ];

        return view('dashboard', compact(
            'total',

            'svm_positif',
            'svm_negatif',
            'svm_netral',

            'smote_positif',
            'smote_negatif',
            'smote_netral',

            'svmMetrics',
            'smoteMetrics'
        ));
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
