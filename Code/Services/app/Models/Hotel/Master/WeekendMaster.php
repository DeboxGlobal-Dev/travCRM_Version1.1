<?php

namespace App\Models\Hotel\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekendMaster extends Model
{
    use HasFactory;
    protected $table = _WEEKEND_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'WeekendDays',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
