<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TfidfResult extends Model
{
    protected $table = 'tfidf_results';

    protected $fillable = [
        'term',
        'tfidf',
    ];
}
