<?php

namespace App\Http\Services\Albums;

use App\Models\AlbumImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteAlbumImagesService
{
    public function deleteImage(Request $request)
    {
        $image = AlbumImages::where('id', $request->image_id)->first();
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }
    }
}
