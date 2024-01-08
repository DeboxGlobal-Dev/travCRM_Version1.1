<?php

namespace App\Models\Transport\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrandMaster extends Model
{
    use HasFactory;
    protected $table = _VEHICLE_BRAND_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'VehicleType',
        'Name',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;

}
