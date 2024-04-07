<?php

namespace App\Http\Services\Albums;

use App\Models\Album;
use App\Models\AlbumImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteAlbumService
{
    public function deleteAlbum(Request $request)
    {
        $albumId = $request->input('album_id');
        $deleteType = $request->input('deleteType');
        $transferAlbumId = $request->input('transfer_album_id');

        $album = Album::findOrFail($albumId);
        $images = AlbumImages::where('album_id', $albumId)->get();

        if ($deleteType === 'del') {
            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                    $image->delete();
                }
            }
        } elseif ($deleteType === 'trans') {
            foreach ($images as $image) {
                $image->update(['album_id' => $transferAlbumId]);
            }
        }
        $album->delete();
        return redirect()->route('albums')->with('success', 'Album deleted successfully!');
    }
}
