<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaCostMaster extends Model
{
    use HasFactory;
    protected $table = _VISA_COST_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Country',
        'VisaType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',

    ];
}
