<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fit extends Model
{
    use HasFactory;
    protected $table = _FIT_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'Name',
     'Destination',
     'Inclusion',
     'Exclusion',
     'TermsCondition',
     'Cancelation',
     'ServiceUpgradation',
     'OptionalTour',
     'PaymentPolicy',
     'Remarks',
     'SetDefault',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
    ];
    public $timestamps = false;
}
