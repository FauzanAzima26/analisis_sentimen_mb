<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredictionResult extends Model
{
    protected $table = 'prediction_results';

    protected $fillable = [
        'tweet',
        'clean_tweet',
        'sentimen_svm',
        'sentimen_smote'
    ];
}
