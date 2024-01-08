<?php

namespace App\Models\Transport\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CruiseMaster extends Model
{
    use HasFactory;
    protected $table = _CRUISE_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'CruisePackageName',
        'Destination',
        'RunningDays',
        'ArrivalTime',
        'DepartureTime',
        'Status',
        'Details',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
