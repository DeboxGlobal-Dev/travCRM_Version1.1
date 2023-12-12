<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCategoryMaster extends Model
{
    use HasFactory;
    protected $table = _HOTEL_CATEGORY_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'UploadKeyword',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
