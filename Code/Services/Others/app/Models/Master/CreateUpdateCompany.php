<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateUpdateCompany extends Model
{
    use HasFactory;
    protected $table = _CREATE_UPDATE_COMPANY_;
    protected $primarykey = "id";
    protected $fillable = [
        'COMPANYNAME',
        'LICENSEKEY',
        'ISACTIVE',
        'ACTIONDATE',
        'LUT',
        'ZIP',
        'PAN',
        'TAN',
        'CIN',
        'ADDRESS1',
        'ADDRESS2',
        'ADDEDBY',
        'UPDATEDBY',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
