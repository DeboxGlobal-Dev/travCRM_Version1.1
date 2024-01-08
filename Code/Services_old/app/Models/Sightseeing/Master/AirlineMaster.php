<?php

namespace App\Models\sightseeing\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AirlineMaster extends Model
{
    use HasFactory;

    protected $table = _AIRLINE_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'ImageName',
        'ImageData',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'   
    ];
    
}
