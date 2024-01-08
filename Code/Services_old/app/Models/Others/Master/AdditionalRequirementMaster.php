<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalRequirementMaster extends Model
{
    use HasFactory;
    protected $table = _ADDITIONAL_REQUIREMENT_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'DestinationId',
        'CurrencyId',
        'CostType',
        'AdultCost',
        'ChildCost',
        'InfantCost',
        'ImageName',
        'ImageData',
        'Details',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
