<?php

namespace App\Models;

use App\Models\Matches;
use Illuminate\Database\Eloquent\Model;

class Championships extends Model
{
    protected $table = 'championships';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function matches()
    {
        return $this->hasMany(Matches::class);
    }
}
