<?php

namespace App\Models\Hotel\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRateMaster extends Model
{
    use HasFactory;
    protected $table = _HOTEL_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'HotelId', 'ClientId', 'MarketType', 'SupplierId', 'PaxType', 'TariffType', 'SeasonType',
        'SeasonYear', 'ValidFrom', 'ValidTo', 'RoomType', 'MealType', 'Currency', 'SingleOccupancy', 'DoubleOccupancy', 'ExtraBedAdult', 'ExtraBedChild', 'ChildWithBed', 'Breakfast', 'Lunch', 'Dinner', 'TAC', 'RoomTaxSlab', 'MealTaxSlab', 'MarkUpType', 'MarkUpValue', 'Remarks', 'Status', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
