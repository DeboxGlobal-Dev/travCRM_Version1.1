<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SacCodeMaster extends Model
{
    use HasFactory;
    protected $table = _SAC_CODE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ServiceType',
        'SacCode',
        'Status',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
