<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterMaster extends Model
{
    use HasFactory;
    protected $table = _LETTER_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'FromDestination',
        'ToDestination',
        'TransferMode',
        'Name',
        'GreetingNote',
        'WelcomeNote',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
       
       
    ];
    public $timestamps = false;
}
