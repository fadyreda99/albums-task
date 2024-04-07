<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All albums') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <a href="{{ route('album.create') }}" style="width: 100%" class="btn btn-primary">Create New</a>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger" style="width: 100%">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success" style="width: 100%">
                        {{ session('success') }}
                    </div>
                @endif

                @if (count($albumes) > 0)
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Controls</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($albumes as $album)
                                <tr>
                                    <td>{{ $album->name }}</td>
                                    <td>
                                        <a href="{{ route('album.edit', ['album_id' => $album->id]) }}"
                                            class="btn btn-success">Edit</a>

                                        <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-album-id="{{ $album->id }}">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger" style="width: 100%">
                        no albums to show
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Album</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('album.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="album_id" id="album_id">

                        <div class="modal-body">
                            <div class="form-check">
                                <input class="form-check-input" value="del" type="radio" name="deleteType"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Delete Album With All Images!
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" value="trans" type="radio" name="deleteType"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Transfer Images To Another Album!
                                </label>

                                <select name="transfer_album_id" id="transfer_album_id" style="display: none;"
                                    class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected>Open this select menu</option>
                                    @foreach ($albumes as $album)
                                        <option value="{{ $album->id }}">{{ $album->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="confirmDelete">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteButtons = document.querySelectorAll(".delete-btn");
            deleteButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var albumId = this.getAttribute("data-album-id");
                    document.getElementById("album_id").value = albumId;
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var delRadio = document.getElementById("flexRadioDefault1");
            var transRadio = document.getElementById("flexRadioDefault2");
            var transferSelect = document.getElementById("transfer_album_id");

            delRadio.addEventListener("change", function() {
                if (this.checked) {
                    transferSelect.style.display = "none";
                }
            });

            transRadio.addEventListener("change", function() {
                if (this.checked) {
                    transferSelect.style.display = "block";
                }
            });
        });
    </script>
</x-app-layout>
