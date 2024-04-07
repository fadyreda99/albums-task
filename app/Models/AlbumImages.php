<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AlbumImages extends Model
{
    use HasFactory;
    protected $table = 'album_images';
    protected $fillable = ['image_name', 'image', 'album_id'];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
}
