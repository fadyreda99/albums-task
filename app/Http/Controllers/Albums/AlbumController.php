<?php

namespace App\Http\Controllers\Albums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Album\DeleteRequest;
use App\Http\Requests\Album\StoreRequest;
use App\Http\Requests\Album\UpdateRequest;
use App\Http\Services\Albums\AllAlbumsService;
use App\Http\Services\Albums\CreateAlbumService;
use App\Http\Services\Albums\DeleteAlbumImagesService;
use App\Http\Services\Albums\DeleteAlbumService;
use App\Http\Services\Albums\EditAlbumService;
use App\Http\Services\Albums\StoreAlbumService;
use App\Http\Services\Albums\UpdateAlbumService;
use App\Models\Album;
use App\Models\AlbumImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    private $allAlbumsService;
    private $createAlbumService;
    private $storeAlbumService;
    private $editAlbumService;
    private $updateAlbumService;
    private $deleteAlbumImagesService;
    private $deleteAlbumService;

    public function __construct(
        AllAlbumsService $allAlbumsService,
        CreateAlbumService $createAlbumService,
        StoreAlbumService $storeAlbumService,
        EditAlbumService $editAlbumService,
        UpdateAlbumService $updateAlbumService,
        DeleteAlbumImagesService $deleteAlbumImagesService,
        DeleteAlbumService $deleteAlbumService
    ) {
        $this->allAlbumsService = $allAlbumsService;
        $this->createAlbumService = $createAlbumService;
        $this->storeAlbumService = $storeAlbumService;
        $this->editAlbumService = $editAlbumService;
        $this->updateAlbumService = $updateAlbumService;
        $this->deleteAlbumImagesService = $deleteAlbumImagesService;
        $this->deleteAlbumService = $deleteAlbumService;
    }
    public function index()
    {
        return $this->allAlbumsService->index();
    }

    public function create()
    {
        return $this->createAlbumService->create();
    }

    public function store(StoreRequest $request)
    {
        return $this->storeAlbumService->store($request);
    }

    public function edit($album_id)
    {
        return $this->editAlbumService->edit($album_id);
    }

    public function update(UpdateRequest $request)
    {
        return $this->updateAlbumService->update($request);
    }

    public function deleteImage(Request $request)
    {
        return $this->deleteAlbumImagesService->deleteImage($request);
    }

    public function deleteAlbum(DeleteRequest $request)
    {
        return $this->deleteAlbumService->deleteAlbum($request);
    }
}
