<?php

namespace App\Models\Hotel\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantMaster extends Model
{
    use HasFactory;
    protected $table = _RESTAURANT_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'DestinationId',
        'Address',
        'CountryId',
        'StateId',
        'CityId',
        'SelfSupplier',
        'PinCode',
        'GSTN',
        'ContactType',
        'ContactName',
        'ContactDesignation',
        'CountryCode',
        'Phone1',
        'Phone2',
        'Phone3',
        'ContactEmail',
        'Image',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
