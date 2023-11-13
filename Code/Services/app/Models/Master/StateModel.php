<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateModel extends Model
{
    use HasFactory;
    protected $table = "master.stateMaster";
    protected $fillable = [
        'id',
        'countryId',
        'name',
        'status',
    ];
}
