<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateMaster extends Model
{
    use HasFactory;
    protected $table = "master.stateMaster";
    protected $primarykey = "id";
    protected $fillable = [
     'Name',
     'CountryId',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'DateAdded',
     'DateUpdated',
     
    ];
    
    public $timestamps = false;

}
