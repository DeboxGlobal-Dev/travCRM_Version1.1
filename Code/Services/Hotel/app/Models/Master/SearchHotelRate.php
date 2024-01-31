<?php

namespace App\Models\Hotel\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchHotelRate extends Model
{
    use HasFactory;
    protected $table = _SEARCH_HOTEL_RATE_;
    protected $primarykey = 'id';
    protected $fillable = [
        'RateCode', 'JsonResult'
    ];
    public $timestamps = false;
}
