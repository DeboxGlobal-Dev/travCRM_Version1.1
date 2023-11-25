<?php

namespace App\Models\Hotel\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmenitiesMaster extends Model
{
    use HasFactory;
    protected $table = _AMENITIES_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
