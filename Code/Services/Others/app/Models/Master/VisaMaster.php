<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaMaster extends Model
{
    use HasFactory;
    protected $table = _VISA_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'VisaType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
