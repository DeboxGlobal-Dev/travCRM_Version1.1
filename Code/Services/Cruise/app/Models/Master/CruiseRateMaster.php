<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CruiseRateMaster extends Model
{
    use HasFactory;
    protected $table = _CRUISE_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ClientId', 'CruiseId', 'MarketType', 'SupplierName', 'TariffType', 'ValidFrom', 'ValidTo', 'TaxSlab', 'CruiseName',
        'CabinType', 'Currency', 'AdultCost', 'ChildCost', 'InfantCost', 
        'Margin', 'Value', 'Remarks', 'Status',
        'JsonItem', 'Destination', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
