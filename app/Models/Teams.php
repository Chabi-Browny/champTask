<?php

namespace App\Models;

use App\Models\Matches;
use App\Models\Player;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'player_one_id',
        'player_two_id',
    ];

    public function playerOnePlayer()
    {
        return $this->belongsTo( Player::class, 'player_one_id' );
    }
    
    public function playerTwoPlayer()
    {
        return $this->belongsTo( Player::class, 'player_two_id' );
    }

    public function matches()
    {
        return $this->hasMany(Matches::class);
    }
}
