<?php

namespace App\Models\sightseeing\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonumentMaster extends Model
{
   

    use HasFactory;
    protected $table = _MONUMENT_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'DestinationId',
        'TransferType',
        'DayId',
        'DefaultQuotation',
        'DefaultProposal',
        'WeekendDays',
        'Details',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
}
