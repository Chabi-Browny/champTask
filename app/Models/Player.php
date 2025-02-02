<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teams;

class Player extends Model
{
    protected $table = 'player';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function teams()
    {
        return $this->hasMany(Teams::class);
    }

}
