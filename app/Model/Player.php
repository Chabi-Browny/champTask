<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Teams;

class Player extends Model
{
    public $table = 'player';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function teams()
    {
        $this->hasMany(Teams::class);
    }

}
