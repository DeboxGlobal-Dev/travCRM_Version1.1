<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationRestriction extends Model
{
    use HasFactory;
    protected $table = _OPERATION_RESTRICTION_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ServiceType',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
