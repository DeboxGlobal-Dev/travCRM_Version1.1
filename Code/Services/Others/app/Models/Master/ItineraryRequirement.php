<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryRequirement extends Model
{
    use HasFactory;
    protected $table = _ITINERARY_REQUIREMENT_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'FromDestination',
     'ToDestination',
     'TransferMode',
     'Title',
     'Description',
     'DrivingDistance',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
    ];
    public $timestamps = false;
}
