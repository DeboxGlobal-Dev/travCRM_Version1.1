<?php

namespace App\Models\Hotel\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanMaster extends Model
{
    use HasFactory;use HasFactory;
    protected $table = _Meal_Plan_Master_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'Name',
        'ShortName',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
