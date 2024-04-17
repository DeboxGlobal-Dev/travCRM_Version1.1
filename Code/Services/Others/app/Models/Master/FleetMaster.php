<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetMaster extends Model
{
    use HasFactory;
    protected $table = _FLEET_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'VehicleType',
        'Parts',
        'EngineNumber',
        'Vehicle',
        'Insurance',
        'Colour',
        'PolicyNumber',
        'FuelType',
        'IssueDate',
        'SeatingCapacity',
        'DueDate',
        'AssignedDriver',
        'PremiumAmount',
        'CategoryVehicleGroup',
        'CoverAmount',
        'RegistrationNumber',
        'RTO',
        'RegisteredOwnerName',
        'TaxEfficiency',
        'PollutionPermitsExpiry',
        'ExpiryDate',
        'RegistrationDate',
        'Permits',
        'Image',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
