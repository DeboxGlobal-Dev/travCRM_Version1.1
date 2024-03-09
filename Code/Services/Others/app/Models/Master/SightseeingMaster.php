<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SightseeingMaster extends Model
{

    use HasFactory;
    protected $table = _SIGHTSEEING_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'SightseeingName',
        'Destination',
        'TransferType',
        'DefaultQuotation',
        'DefaultProposal',
        'Description',
        'InclusionsExclusionsTiming',
        'ImportantNote',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',

    ];
}
