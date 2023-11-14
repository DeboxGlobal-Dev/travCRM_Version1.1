<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTypeMaster extends Model
{
    use HasFactory;
    protected $table = 'BusinessTypeMaster';
    protected $primarykey = 'id'; 
    protected $fillable = [
        'name',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'status',
       
       
    ];
    public $timestamps = false;
}
