<?php

namespace App\Model;

use App\Model\Matches;
use App\Model\Player;
use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    protected $primaryKey = 'id';

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
    public function playerTowPlayer()
    {
        return $this->belongsTo( Player::class, 'player_two_id' );
    }

    public function matches()
    {
        return $this->hasMany(Matches::class);
    }
}
