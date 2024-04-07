<?php

namespace App\Http\Services\Albums;

use App\Models\Album;
use App\Models\AlbumImages;
use Illuminate\Http\Request;

class StoreAlbumService
{
    public function store(Request $request)
    {
        $albumName = $request->input('name');
        $images = $request->file('image', []);
        $imageNames = $request->input('image_name', []);

        $album = Album::create(['name' => $albumName]);

        foreach ($images as $key => $image) {
            $savedImage = $image->store('uploads/images/albums', ['disk' => 'public']);
            AlbumImages::create([
                'image' => $savedImage,
                'image_name' => $imageNames[$key],
                'album_id' => $album->id
            ]);
        }

        return redirect()->route('albums')->with('success', 'Album created successfully!');
    }
}
