<?php 
namespace App\Http\Services\Albums;

use App\Models\Album;

class EditAlbumService{
    public function edit($album_id)
    {
        $album = Album::with('images')->where('id', $album_id)->first();
        return view('albums.edit', compact('album'));
    }
}