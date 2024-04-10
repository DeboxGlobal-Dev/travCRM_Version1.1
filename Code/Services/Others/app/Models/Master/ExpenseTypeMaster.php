<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTypeMaster extends Model
{
    use HasFactory;
    protected $table = _EXPENSE_TYPE_MASTER;
    protected $primarykey = 'id';
    protected $fillable = [
        'ExpenseHead',
        'ExpenseType',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
