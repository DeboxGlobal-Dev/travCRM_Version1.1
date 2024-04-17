<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyMaster extends Model
{
    use HasFactory;
    protected $table = _CURRENCY_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'CountryId',
     'CurrencyCode',
     'CurrencyName',
     'Status',
     'SetDefault',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
    ];
    public $timestamps = false;
}
