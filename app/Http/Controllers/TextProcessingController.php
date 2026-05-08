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

    public function run()
    {
        ImportDataset::chunk(100, function ($datasets) {

            foreach ($datasets as $data) {

                // skip kalau sudah diproses
                if ($data->sentiment && $data->clean_tweet) {
                    continue;
                }

                try {

                    $response = Http::timeout(15)->post(
                        'http://127.0.0.1:5000/predict',
                        [
                            'text' => $data->tweet
                        ]
                    );

                    if ($response->failed()) {
                        continue;
                    }

                    $result = $response->json();

                    $data->clean_tweet = $result['clean_text'] ?? null;
                    $data->sentiment = $result['sentiment'] ?? null;

                    $data->save();
                } catch (\Exception $e) {
                    continue;
                }
            }
        });

        return response()->json([
            'success' => true
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
