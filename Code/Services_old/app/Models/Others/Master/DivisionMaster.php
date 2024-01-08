<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionMaster extends Model
{
    use HasFactory;
    protected $table = _DIVISION_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'Name',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
     
    ];
}
