<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourEscortMaster extends Model
{
    use HasFactory;
    protected $table = _TOUR_ESCORT_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ServiceType',
        'Name',
        'MobileNumber',
        'WhatsAppNumber',
        'AlternateNumber',
        'Email',
        'TourEscortLicenseOne',
        'LicenseExpiry',
        'Destination',
        'Language',
        'TourEscortImageName',
        'TourEscortImageData',
        'Supplier',
        'TourEscortLicenseTwo',
        'ContactPerson',
        'Designation',
        'Country',
        'State',
        'City',
        'PinCode',
        'Detail',
        'Address',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',

    ];
    public $timestamps = false;
}
