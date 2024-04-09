<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeMaster extends Model
{
    use HasFactory;
    protected $table = _ROOM_TYPE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'RoomName',
        'MaximumOccupancy',
        'Bedding',
        'Size',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
