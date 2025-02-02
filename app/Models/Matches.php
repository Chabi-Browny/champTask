<?php

namespace App\Models;

use App\Models\Championships;
use App\Models\Teams;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'championship_id',
        'team_one_id',
        'team_two_id',
        'date',
        'team_one_score',
        'team_two_score',
    ];


    public function championships()
    {
        return $this->belongsTo(Championships::class, 'championship_id');
    }

    public function teamOneTeams()
    {
        return $this->belongsTo(Teams::class, 'team_one_id');
    }

    public function teamTwoTeams()
    {
        return $this->belongsTo(Teams::class, 'team_two_id');
    }
}
