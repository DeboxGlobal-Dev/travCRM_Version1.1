<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMaster extends Model
{
    use HasFactory;
    protected $table = _COUNTRY_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
        'Name',
        'ShortName',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
    ];
    
    public $timestamps = false;

    
}
