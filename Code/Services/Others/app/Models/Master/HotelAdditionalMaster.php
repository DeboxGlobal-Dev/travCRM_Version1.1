<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAdditionalMaster extends Model
{
    use HasFactory;
    protected $table = _HOTEL_ADDITIONAL_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'Details',
        'ImageName',
        'ImageData',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
