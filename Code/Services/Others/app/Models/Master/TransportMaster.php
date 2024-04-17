<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportMaster extends Model
{
    use HasFactory;
    protected $table = _TRANSPORT_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'Name',
        'Destinations',
        'TransferType',
        'Detail',
        'Default',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
