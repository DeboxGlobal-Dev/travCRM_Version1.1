<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationMaster extends Model
{
    use HasFactory;
    protected $table = "destinationmaster";
    protected $primarykey = "id";
    protected $fillable = [
     'CountryId',
     'State',
     'DestinationName',
     'Description',
     'SetDefault',
     'AddedBy',
     'UpdatedBy',
     'status',
    ];
    public $timestamps = false;
}
