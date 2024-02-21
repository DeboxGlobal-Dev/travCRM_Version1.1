<?php

namespace App\Models\QueryBuilder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryMaster extends Model
{
    use HasFactory;
    protected $table = _QUERY_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'QueryId', 'ClientType', 'LeadPax', 'Subject', 'QueryType', 'Priority', 'TAT', 'LeadSource', 'AddedBy', 'UpdatedBy', 'FromDate', 'ToDate', 'QueryJson', 'created_at', 'updated_at'
    ];

    public $timestamps = false;
}
