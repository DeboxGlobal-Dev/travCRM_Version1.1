<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverMaster extends Model
{
    use HasFactory;
    protected $table = _DRIVER_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Country',
        'DriverName',
        'MobileNumber',
        'AlternateMobileNo',
        'WhatsappNumber',
        'LicenseNumber',
        'BirthDate',
        'LicenseName',
        'LicenseData',
        'PassportNumber',
        'Address',
        'ValidUpto',
        'ImageName',
        'ImageData',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;

}
