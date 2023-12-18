<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetailsMaster extends Model
{
    use HasFactory;
    protected $table = _CONTACT_PERSON_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'ParentId',
        'Title',
        'Name',
        'Designation',
        'CountryCode',
        'Phone1',
        'Phone2',
        'Phone3',
        'Email1',
        'Email2',
        'Type',
        'SetDefault',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
