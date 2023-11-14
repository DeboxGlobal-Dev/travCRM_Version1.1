<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryMaster extends Model
{
    use HasFactory;
   protected $table = "countrymaster";
   protected $primarykey = "id";
   protected $fillable = [
    'name',
    'ShortName',
    'SetDefault',
    'AddedBy',
    'UpdatedBy',
    'status',
   ];
   public $timestamps = false;
}
