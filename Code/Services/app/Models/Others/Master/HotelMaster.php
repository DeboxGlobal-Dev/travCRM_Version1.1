<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelMaster extends Model
{
    use HasFactory;
    protected $table = _HOTEL_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'HotelChain', 'HotelName', 'HotelCode', 'HotelCategory', 'HotelType', 'HotelCountry', 'HotelState',
        'HotelCity', 'HotelPinCode', 'HotelAddress', 'HotelLocality', 'HotelGSTN', 'HotelWeekend', 'CheckIn', 'CheckOut', 'HotelLink', 'HotelInfo', 'HotelPolicy', 'HotelTC', 'HotelAmenties', 'HotelRoomType', 'HotelStatus', 'SelfSupplier', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
