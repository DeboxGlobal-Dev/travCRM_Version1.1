<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryRateMaster extends Model
{
    use HasFactory;
    protected $table = _FERRY_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ClientId', 'FerryId', 'MarketType', 'SupplierName', 'ValidFrom', 'ValidTo', 'TaxSlab', 'FerryName',
        'FerrySeat', 'Currency', 'AdultCost', 'ChildCost', 'InfantCost', 
        'ProcessingFee', 'MiscCost', 'Remarks', 'Status',
        'JsonItem', 'Destination', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
