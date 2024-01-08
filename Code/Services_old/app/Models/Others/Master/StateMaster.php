<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateMaster extends Model
{
    use HasFactory;
    protected $table = _STATE_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'Name',
     'CountryId',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
     
    ];
    
    public $timestamps = false;

}
