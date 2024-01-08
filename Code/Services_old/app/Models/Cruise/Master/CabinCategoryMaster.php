<?php

namespace App\Models\Transport\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinCategoryMaster extends Model
{
    use HasFactory;
    protected $table = _CABIN_CATEGORY_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
