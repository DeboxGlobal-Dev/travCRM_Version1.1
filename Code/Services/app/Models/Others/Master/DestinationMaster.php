<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationMaster extends Model
{
    use HasFactory;
    protected $table = _DESTINATION_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'CountryId',
     'State',
     'DestinationName',
     'Description',
     'SetDefault',
     'AddedBy',
     'UpdatedBy',
     'Status',
    ];
    public $timestamps = false;
}
