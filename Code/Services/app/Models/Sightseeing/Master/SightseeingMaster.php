<?php

namespace App\Models\sightseeing\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SightseeingMaster extends Model
{
   
    use HasFactory;
    protected $table = _SIGHTSEEING_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'DestinationId',
        'TransferType',
        'DefaultQuotation',
        'DefaultProposal',
        'CurrencyId',
        'AdultCost',
        'ChildCost',
        'Details',
        'InclusionsExclusionsTiming',
        'ImportantNote',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
    ];
}
