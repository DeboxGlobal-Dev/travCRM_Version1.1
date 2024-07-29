<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NationalityMaster extends Model
{
    use HasFactory;
    use softDeletes;
    protected $table = _NATIONALITY_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'
    ];
    protected $dates = ['deleted_at'];
}
