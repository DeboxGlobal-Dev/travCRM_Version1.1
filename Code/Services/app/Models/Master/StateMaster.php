<?php

namespace App\Models\Master;

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
     'AddedBy',
     'UpdatedBy',
     'Status',
     'DateAdded',
     
    ];
    public $timestamps = false;
}
