<?php

namespace App\Models\sightseeing\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainMaster extends Model
{
    use HasFactory;
    protected $table = _TRAIN_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable =  [
        'Name',
        'ImageName',
        'ImageData',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
}
