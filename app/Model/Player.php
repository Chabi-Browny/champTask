<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Teams;

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
