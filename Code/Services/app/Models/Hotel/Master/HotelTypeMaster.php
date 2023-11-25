<?php

namespace App\Models\Hotel\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelTypeMaster extends Model
{
    use HasFactory;
    protected $table = _HOTEL_TYPE_MASTER_;
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
