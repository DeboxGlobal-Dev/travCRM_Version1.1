<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageMaster extends Model
{
    use HasFactory;
    protected $table = _PACKAGE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Status',
        'Data',
    ];

    protected $casts = [
        'Data' => 'array'
    ];



}
