<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityMaster extends Model
{
    use HasFactory;
    protected $table = 'citymaster';
    protected $primarykey = 'id'; 
    protected $fillable = [
        'name',
        'CountryId',
        'StateId',
        'AddedBy',
        'UpdatedBy',
        'status',
       
       
    ];
    public $timestamps = false;
}