<?php

namespace App\Model;

use App\Model\Matches;
use App\Model\Player;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name',
        'player_one_id',
        'player_two_id',
    ];

    public $timestamps = false;

    public function playerOne()
    {
        $this->belongsTo( Player::class, 'player_one_id' );
    }
    public function playerTow()
    {
        $this->belongsTo( Player::class, 'player_two_id' );
    }

    public function matches()
    {
        $this->hasMany(Matches::class);
    }
}
