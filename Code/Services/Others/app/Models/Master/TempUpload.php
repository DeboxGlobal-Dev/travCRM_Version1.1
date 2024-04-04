<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUpload extends Model
{
    use HasFactory;
    protected $table = _TEMP_UPLOAD_DATA_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ServiceType',
        'UploadJson',
        'Status',
        'AddedBy',
        'UpdatedBy', 
        'created_at', 
        'updated_at'
    ];
    public $timestamps = false;
}
