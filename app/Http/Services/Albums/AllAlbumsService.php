<?php
namespace App\Http\Services\Albums;

use App\Models\Album;

class AllAlbumsService{
    public function index()
    {
        $albumes = Album::with('images')->get();
        return view('albums.index', compact('albumes'));
    }
}