<?php

namespace App\Http\Services\Albums;

use App\Models\Album;
use App\Models\AlbumImages;
use Illuminate\Http\Request;

class UpdateAlbumService
{
    public function update(Request $request)
    {
        $albumId = $request->input('id');
        $albumName = $request->input('name');
        $existingImageIds = $request->input('image_ids', []);
        $newImages = $request->file('new_image', []);
        $newImageNames = $request->input('new_image_name', []);

        $album = Album::findOrFail($albumId);
        $album->update(['name' => $albumName]);

        foreach ($existingImageIds as $key => $imageId) {
            $img = AlbumImages::findOrFail($imageId);
            $img->update(['image_name' => $request->input("image_name.$key")]);
        }

        foreach ($newImages as $key => $newImage) {
            $savedImage = $newImage->store('uploads/images/albums', ['disk' => 'public']);
            AlbumImages::create([
                'image' => $savedImage,
                'image_name' => $newImageNames[$key],
                'album_id' => $albumId
            ]);
        }
        return redirect()->route('album.edit', ['album_id' => $albumId])->with('success', 'Album updated successfully!');
    }
}
