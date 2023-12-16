<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketMaster extends Model
{
    use HasFactory;
    protected $table = _MARKET_MASTER_;
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
