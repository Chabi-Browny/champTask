<?php

namespace App\Model;

use App\Model\Matches;
use Illuminate\Database\Eloquent\Model;

class Championships extends Model
{
    protected $table = 'championships';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function matches()
    {
        $this->hasMany(Matches::class);
    }
}
