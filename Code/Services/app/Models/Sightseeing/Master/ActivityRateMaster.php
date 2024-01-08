<?php

namespace App\Models\Sightseeing\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityRateMaster extends Model
{
    use HasFactory;
    protected $table = _ACTIVITY_RATE_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'SupplierName',
        'Nationality',
        'TraficType',
        'RateValidFrom',
        'RateValidTo',
        'Currency',
        'TransferType',
        'AdultTicketCost',
        'ChildTicketCost',
        'InfantTicketCost',
        'MarkupType',
        'MarkupCost',
        'TaxSlab',
        'Remark',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'     
    ];
}
