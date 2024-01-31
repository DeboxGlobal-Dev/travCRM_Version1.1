<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchActivityRate extends Model
{
    use HasFactory;
    protected $table = _SEARCH_ACTIVITY_RATE_;
    protected $primarykey = 'id';
    protected $fillable = [
        'RateCode', 'JsonResult'
    ];
    public $timestamps = false;
}
