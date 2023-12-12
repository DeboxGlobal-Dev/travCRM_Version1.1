<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonMaster extends Model
{
    use HasFactory;
    protected $table = _SEASOM_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'FromDate',
        'ToDate ',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
