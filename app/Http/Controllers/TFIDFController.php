<?php

namespace App\Http\Controllers;

use App\Models\ImportDataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TFIDFController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tf-idf');
    }

    public function data()
    {
        $response = Http::timeout(60)->post(
            'http://127.0.0.1:5000/tfidf',
            [
                'texts' => ImportDataset::whereNotNull('clean_tweet')
                    ->pluck('clean_tweet')
                    ->toArray()
            ]
        );

        if ($response->failed()) {
            return response()->json([
                'error' => $response->body()
            ]);
        }

        return response()->json(
            $response->json()['data'] ?? []
        );
    }

    public function tfidf()
    {
        $texts = ImportDataset::whereNotNull('clean_tweet')
            ->pluck('clean_tweet')
            ->toArray();

        if (empty($texts)) {
            return response()->json([]);
        }

        $response = Http::post(
            'http://127.0.0.1:5000/tfidf',
            [
                'texts' => $texts
            ]
        );

        return response()->json(
            $response->json()['data']
        );
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
