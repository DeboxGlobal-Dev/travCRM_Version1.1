<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class main extends Model
{

    // use SoftDeletes;
    use HasFactory;
    protected $table = 'travcrm';
    protected $primarykey = 'id'; 
    protected $fillable = [
        'name',
        'description',
        'addedby',
        'updatedby',
        'status',
       
       
    ];
    public $timestamps = false;
}

