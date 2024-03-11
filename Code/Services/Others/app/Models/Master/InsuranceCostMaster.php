<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCostMaster extends Model
{
    use HasFactory;
    protected $table = _INSURANCE_COST_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'InsuranceName',
        'InsuranceType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',

    ];
}
