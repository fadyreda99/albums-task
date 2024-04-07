<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Album') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-10">
                @if ($errors->any())
                    <div class="alert alert-danger" style="width: 100%">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="post" action="{{ route('album.store') }}" class="row g-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="col-md-12">
                        <input type="text" class="form-control form-control-sm" id="validationCustom01"
                            placeholder="album name" name="name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div id="imageUploadContainer" class="col-md-12 text-center"
                        style="border: 1px solid #ccc; padding: 10px;">
                        <div class="col-md-12 text-left mb-3">
                            <button type="button" class="btn btn-outline-primary" id="addImageBtn">Add Image</button>
                        </div>

                        <div class="row justify-content-center image-upload mb-3">
                            <div class="col-md-6">
                                <input type="file" class="form-control form-control-sm" name="image[]" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm" placeholder="Image Name"
                                    name="image_name[]" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary col-12" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addImageBtn').addEventListener('click', function() {
            var imageUploadContainer = document.getElementById('imageUploadContainer');
            var clone = imageUploadContainer.querySelector('.image-upload').cloneNode(true);
            var inputs = clone.querySelectorAll('input[type="file"], input[type="text"]');
            inputs.forEach(function(input) {
                input.value = '';
            });
            imageUploadContainer.appendChild(clone);
        });
    </script>
</x-app-layout>
