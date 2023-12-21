<?php

namespace App\Models\Others\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGalleryMaster extends Model
{
    use HasFactory;
    protected $table = _IMAGE_GALLERY_MASTER_;
    protected $primarykey = 'id'; 
    protected $fillable = [
        'ImageName',
        'ImageData',
        'Type',
        'ParentId',
        'Status',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',  
    ];
}
