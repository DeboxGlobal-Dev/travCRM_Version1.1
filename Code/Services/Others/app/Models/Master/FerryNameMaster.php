<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryNameMaster extends Model
{
    use HasFactory;
    protected $table = _FERRY_NAME_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'FerryCompany',
        'FerryName',
        'Capacity',
        'ImageName',
        'ImageData',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;

}
