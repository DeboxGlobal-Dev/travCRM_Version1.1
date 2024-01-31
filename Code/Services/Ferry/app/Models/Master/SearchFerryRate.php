<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchFerryRate extends Model
{
    use HasFactory;
    protected $table = _SEARCH_FERRY_RATE_;
    protected $primarykey = 'id';
    protected $fillable = [
        'RateCode', 'JsonResult'
    ];
    public $timestamps = false;
}
