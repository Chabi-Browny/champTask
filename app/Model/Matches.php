<?php

namespace App\Model;

use App\Model\Championships;
use App\Model\Teams;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'date',
        'championship_id',
        'tema_one_id',
        'tema_one_score',
        'tema_two_id',
        'tema_two_score',
    ];

    public $timestamps = false;

    public function championships()
    {
        $this->belongsTo(Championships::class, 'championship_id');
    }

    public function teamOne()
    {
        $this->belongsTo(Teams::class, 'tema_one_id');
    }

    public function teamTwo()
    {
        $this->belongsTo(Teams::class, 'tema_two_id');
    }
}
