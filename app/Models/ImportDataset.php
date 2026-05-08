<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportDataset extends Model
{
    protected $table = 'datasets';

    protected $fillable = [
        'tweet',
        'sentimen',
        'tweet_preprocessing'
    ];
}
