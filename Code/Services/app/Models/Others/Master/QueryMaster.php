<?php

namespace App\Models\Others\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryMaster extends Model
{
    use HasFactory;
    protected $table = _QUERY_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'QueryId',
        'ClientType',
        'AgentId',
        'LeadPax',
        'Subject',
        'AddEmail',
        'AdditionalInfo',
        'QueryType',
        'ValueAddedServices',
        'TravelInfo',
        'PaxType',
        'TravelDate',
        'PaxInfo',
        'RoomInfo',
        'Priority',
        'TAT',
        'TourType',
        'LeadSource',
        'LeadRefrenceId',
        'HotelPrefrence',
        'HotelType',
        'MealPlan',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
}
