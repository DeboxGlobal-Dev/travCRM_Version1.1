<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseHeadMaster extends Model
{
    use HasFactory;
    protected $table = _EXPENSE_HEAD_MASTER;
    protected $primarykey = 'id';
    protected $fillable = [
        'ExpenseHead',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
