<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleMaster extends Model
{
    use HasFactory;
    protected $table = _MODULE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'SerialNumber',
        'ModuleName',
        'ModuleType',
        'Url',
        'Icon',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'
    ];
}
