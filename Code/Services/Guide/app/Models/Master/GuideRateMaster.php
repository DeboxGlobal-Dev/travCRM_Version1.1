<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideRateMaster extends Model
{
    use HasFactory;
    protected $table = _GUIDE_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ClientId', 'GuideId', 'SupplierName', 'ValidFrom', 'ValidTo', 'PaxRange', 'DayType',
        'UniversalCost', 'Currency', 'ServiceCost', 'LanguageAllowance', 'OtherCost', 
        'GST', 'Status', 'JsonItem', 'Destination', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
