<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerrySearMaster extends Model
{
    use HasFactory;
    protected $table = _FERRY_SEAR_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'FerrySeat',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',

    ];
}
