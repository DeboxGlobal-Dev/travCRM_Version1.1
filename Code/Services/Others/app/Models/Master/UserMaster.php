<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    use HasFactory;
    protected $table = _USER_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Title',
        'Data',
    ];

    protected $casts = [
        'Data' => 'array'
    ];
}
