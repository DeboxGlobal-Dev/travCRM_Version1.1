<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CruiseCompanyMaster extends Model
{
    use HasFactory;
    protected $table = _CRUISE_COMPANY_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'CruiseCompanyName',
        'Destination',
        'Country',
        'State',
        'City',
        'PinCode',
        'Address',
        'Website',
        'GST',
        'SelfSupplier',
        'Type',
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
