<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonumentMaster extends Model
{


    use HasFactory;
    protected $table = _MONUMENT_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'MonumentName',
        'Destination',
        'TransferType',
        'ClosedOnDays',
        'DefaultQuotation',
        'DefaultProposal',
        'WeekendDays',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'Description',
        'created_at',
        'updated_at',


    ];
}
