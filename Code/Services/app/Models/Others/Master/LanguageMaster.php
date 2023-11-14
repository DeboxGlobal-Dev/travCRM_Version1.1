<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageMaster extends Model
{
    use HasFactory;
    protected $table = "languagemaster";
    protected $primarykey = "id";
    protected $fillable = [
     'name',
     'AddedBy',
     'UpdatedBy',
     'status',
    ];
    public $timestamps = false;
}
