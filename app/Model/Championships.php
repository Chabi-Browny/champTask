<?php

namespace App\Model;

use App\Model\Matches;
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
