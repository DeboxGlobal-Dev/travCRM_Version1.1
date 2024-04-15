<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationMaster extends Model
{
    use HasFactory;
    protected $table = _DESTINATION_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'CountryId',
     'StateId',
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
