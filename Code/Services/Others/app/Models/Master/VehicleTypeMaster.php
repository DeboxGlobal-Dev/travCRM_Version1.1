<?php

namespace App\Models\Transport\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTypeMaster extends Model
{
    use HasFactory;
    protected $table = _VEHICLE_TYPE_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'PaxCapacity',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
