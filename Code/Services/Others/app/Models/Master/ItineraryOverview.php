<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryOverview extends Model
{
    use HasFactory;
    protected $table = _ITINERARY_OVERVIEW_;
    protected $primarykey = "id";
    protected $fillable = [
     'OverviewName',
     'OverviewInformation',
     'HighlightInformation',
     'ItineraryIntroduction',
     'ItinerarySummary',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
    ];
    public $timestamps = false;
}
