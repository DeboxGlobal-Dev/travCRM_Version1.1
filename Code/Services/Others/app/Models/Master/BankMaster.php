<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankMaster extends Model
{
    use HasFactory;
    protected $table = _BANK_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'BankName',
        'AccountNumber',
        'BranchAddress',
        'UpiId',
        'AccountType',
        'BeneficiaryName',
        'BranchIfsc',
        'BranchSwiftCode',
        'ImageName',
        'ImageData',
        'ShowHide',
        'SetDefault',
        'AddedBy',
        'UpdatedBy',
        'Status',
        'created_at',
        'updated_at',


    ];
    public $timestamps = false;
}
