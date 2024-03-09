<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceTypeMaster extends Model
{
    use HasFactory;
    protected $table = _INSURANCE_TYPE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'InsuranceType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',

    ];
}
