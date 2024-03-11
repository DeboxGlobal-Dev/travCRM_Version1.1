<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourEscortPriceMaster extends Model
{
    use HasFactory;
    protected $table = _TOUR_ESCORT_PRICE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ServiceType',
        'Destination',
        'TourEscortService',
        'Status',
        'Default',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
