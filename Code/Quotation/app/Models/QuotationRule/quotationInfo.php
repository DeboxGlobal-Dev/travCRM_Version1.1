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
        'Adult',
        'Child',
        'TotalPax',
        'LeadPaxName',
        'JsonData',
        'Version',
        'Is_flag',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at'
    ];

}
