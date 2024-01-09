<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTypeMaster extends Model
{
    use HasFactory;
    protected $table = _BUSINESS_TYPE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
