<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainRateMaster extends Model
{
    use HasFactory;

    protected $table = _TRAIN_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ClientId', 'TrainId', 'TrainNumber', 'TrainClass', 'JourneyType', 'Currency', 'ValidFrom', 'ValidTo', 'AdultCost', 'ChildCost',
        'InfantCost', 'Remarks', 'Status', 'JsonItem', 'Destination', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
