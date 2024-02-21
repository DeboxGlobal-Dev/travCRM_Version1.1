<?php

namespace App\Models\QueryBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryMaster extends Model
{
    use HasFactory;
    protected $table = _QUERY_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
          'QueryId',
          'FDCode',
          'PackageCode',
          'PackageName',
          'ClientType',
          'AgentId',
          'LeadPax', 
          'Subject',
          'AddEmail',
          'AdditionalInfo',
          "QueryType",
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
          //'QueryJson', 
          'created_at', 
          'updated_at'
    ];

    protected $casts = [
        'ValueAddedServices' => 'array',
         'TravelDate' => 'array',
        'PaxInfo' => 'array',
        'RoomInfo' => 'array'
    ];
}
