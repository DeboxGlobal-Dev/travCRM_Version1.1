<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageMaster extends Model
{
    use HasFactory;
    protected $table = _LANGUAGE_MASTER_;
    protected $primarykey = "id";
    protected $fillable = [
     'Name',
     'Status',
     'AddedBy',
     'UpdatedBy',
     'created_at',
     'updated_at',
    ];
    public $timestamps = false;
}
