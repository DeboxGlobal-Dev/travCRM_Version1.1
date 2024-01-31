<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryCompanyMaster extends Model
{
    use HasFactory;
    protected $table = _FERRY_COMPANY_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'FerryCompanyName',
        'Destination',
        'Website',
        'SelfSupplier',
        'Type',
        'ContactPers',
        'Designation',
        'Phone',
        'Email',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
