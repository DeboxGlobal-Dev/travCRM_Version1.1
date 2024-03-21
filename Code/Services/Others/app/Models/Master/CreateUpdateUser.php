<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateUpdateUser extends Model
{
    use HasFactory;
    protected $table = _USERS_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
        'CompanyKey',
        'UserCode',
        'FirstName',
        'LastName',
        'Email',
        'Phone',
        'Mobile',
        'Password',
        'PIN',
        'Role',
        'Street',
        'LanguageKnown',
        'TimeFormat',
        'Profile',
        'Destination',
        'UsersDepartment',
        'ReportingManager',
        'UserType',
        'UserLoginType',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
        'UserKey',
        'Status',
    ];

    public $timestamps = false;
}
