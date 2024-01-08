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
     'Name',
     'Description',
     'SetDefault',
     'AddedBy',
     'UpdatedBy',
     'Status',
     'created_at',
     'updated_at',
    ];
    public $timestamps = false;
}
