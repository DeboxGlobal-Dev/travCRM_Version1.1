<?php

namespace App\Models\Transport\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CruiseNameMaster extends Model
{
    use HasFactory;
    protected $table = _CRUISE_NAME_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'CruiseCompany',
        'CruiseName',
        'Status',
        'ImageName',
        'ImageData',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
