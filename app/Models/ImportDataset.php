<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportDataset extends Model
{
    protected $table = 'datasets';

    protected $fillable = [
        'tweet',
        'sentiment',
        'clean_tweet'
    ];
}
