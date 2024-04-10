<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxMaster extends Model
{
    use HasFactory;
    protected $table = _TAX_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ServiceType',
        'TaxSlabName',
        'TaxValue',
        'Status',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
