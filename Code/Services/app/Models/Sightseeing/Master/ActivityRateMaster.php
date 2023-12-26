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
        'Supplier_name',
        'Nationality',
        'Trafic_type',
        'Rate_valid_from',
        'Rate_valid_to',
        'Currency',
        'Transfer_type',
        'Adult_ticket_cost',
        'Child_ticket_cost',
        'Infant_ticket_cost',
        'Status',
        'Markup_type',
        'Markup_cost',
        'Tax_slab',
        'Remark',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'     
    ];
}
