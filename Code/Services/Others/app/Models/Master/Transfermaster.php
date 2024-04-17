<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfermaster extends Model
{
    use HasFactory;
    protected $table = _TRANSFER_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'TransferName',
        'Destinations',
        'TransferType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}