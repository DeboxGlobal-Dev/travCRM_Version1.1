<?php

namespace App\Models\Hotel\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMaster extends Model
{
    use HasFactory;
    protected $table = _ROOM_MASTER_;
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
