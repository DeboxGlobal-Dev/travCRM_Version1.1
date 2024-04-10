<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonMaster extends Model
{
    use HasFactory;
    protected $table = _SEASON_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'SeasonName',
        'FromDate',
        'ToDate',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
