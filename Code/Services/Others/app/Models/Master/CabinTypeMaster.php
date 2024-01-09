<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinTypeMaster extends Model
{
    use HasFactory;
    protected $table = _CABIN_TYPE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'CruiseName',
        'CabinType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;

}
