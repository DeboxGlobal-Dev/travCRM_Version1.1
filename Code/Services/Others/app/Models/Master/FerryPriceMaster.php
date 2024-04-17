<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryPriceMaster extends Model
{
    use HasFactory;
    protected $table = _FERRY_PRICE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'FromDestination',
        'ToDestination',
        'ArrivalTime',
        'DepartureTime',
        'Detail',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
