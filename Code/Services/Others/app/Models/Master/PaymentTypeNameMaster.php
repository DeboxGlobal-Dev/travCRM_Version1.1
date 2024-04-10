<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypeNameMaster extends Model
{
    use HasFactory;
    protected $table = _PAYMENT_TYPE_NAME_MASTER;
    protected $primarykey = 'id';
    protected $fillable = [
        'PaymentTypeName',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
