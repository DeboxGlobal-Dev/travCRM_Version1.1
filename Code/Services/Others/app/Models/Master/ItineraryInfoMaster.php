<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryInfoMaster extends Model
{
    use HasFactory;
    protected $table = _ITINERARY_INFO_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'FromDestination',
        'ToDestination',
        'TransferMode',
        'Title',
        'DrivingDistance',
        'Details',
        'Status',
        'AddedBy',
        'UpdatedBy',
        //'created_at',
        //'updated_at',
    ];
    public $timestamps = false;
}
