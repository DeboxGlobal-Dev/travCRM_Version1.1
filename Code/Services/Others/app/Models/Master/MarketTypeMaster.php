<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketTypeMaster extends Model
{
    use HasFactory;
    protected $table = _MARKET_TYPE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'
    ];
}
