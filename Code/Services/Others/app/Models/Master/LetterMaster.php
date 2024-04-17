<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterMaster extends Model
{
    use HasFactory;
    protected $table = _LETTER_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
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
