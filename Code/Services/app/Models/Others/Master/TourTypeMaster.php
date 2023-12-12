<?php

namespace App\Models\Hotel\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourTypeMaster extends Model
{
    use HasFactory;
    protected $table = _TOUR_TYPE_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
