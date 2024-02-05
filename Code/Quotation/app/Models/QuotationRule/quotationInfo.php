<?php

namespace App\Models\QuotationRule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class QuotationInfo extends Model
{
    use HasFactory;

    protected $table = _QUOTATION_INFO_;
    protected $primarykey = 'id';
    protected $fillable = [
        'QueryId',
        'Subject',
        'FromDate',
        'ToDate',
        'TotalPax',
        'Adult',
        'Child',
        'LeadPaxName',
        'JsonData',
        'Status',
        'AddedBy',
        'created_at',
        'updated_at'
    ];

}
