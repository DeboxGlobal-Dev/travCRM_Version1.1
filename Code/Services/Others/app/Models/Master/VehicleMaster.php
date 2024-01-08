<?php

namespace App\Models\Transport\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaster extends Model
{
    use HasFactory;
    protected $table = _VEHICLE_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'VehicleType',
        'Capacity',
        'VehicleBrand',
        'Name',
        'ImageName',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;

}
