<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Album') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success" style="width: 100%">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" style="width: 100%">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('album.update') }}" class="row g-3 needs-validation"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $album->id }}">

                    <div class="col-md-12">
                        <input type="text" class="form-control form-control-sm" id="validationCustom01"
                            placeholder="album name" name="name" value="{{ $album->name }}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>

                    <div id="" class="col-md-12 text-center" style="border: 1px solid #ccc; padding: 10px;">
                        @foreach ($album['images'] as $image)
                            <div class="row justify-content-center image-upload mb-3">
                                <div class="col-md-10 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger delete-image-btn m-2"
                                        data-image-id="{{ $image->id }}">Delete</button>

                                    <input type="hidden" name="image_ids[]" value="{{ $image->id }}">

                                    <input type="text" class="form-control form-control-sm" placeholder="Image Name"
                                        value="{{ $image->image_name }}" name="image_name[]" required />

                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <img src="{{ url('storage/' . $image->image) }}"
                                        style="width: 100px; height: 100px;">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div id="imageUploadContainer" class="col-md-12 text-center"
                        style="border: 1px solid #ccc; padding: 10px;">
                        <div id="imageUploadContainer" class="col-md-12 text-center"
                            style="border: 1px solid #ccc; padding: 10px; display: none;">
                            <div class="row justify-content-center image-upload mb-3">
                                <div class="col-md-6">
                                    <input type="file" class="form-control form-control-sm" name="new_image[]"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-control-sm" placeholder="Image Name"
                                        name="new_image_name[]" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-left mb-3">
                            <button type="button" class="btn btn-outline-primary" id="addImageBtn">Add new
                                Image</button>
                        </div>

                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary col-12" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-image-btn').click(function() {
                var imageId = $(this).data('image-id');
                var formData = {
                    '_token': '{{ csrf_token() }}',
                    'image_id': imageId
                };
                var button = $(this);
                $.ajax({
                    url: "{{ route('album.image.delete') }}",
                    type: "DELETE",
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        button.closest('.image-upload').remove();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('addImageBtn').addEventListener('click', function() {
            var imageUploadContainer = document.getElementById('imageUploadContainer');
            var clone = imageUploadContainer.querySelector('.image-upload').cloneNode(true);
            var inputs = clone.querySelectorAll('input[type="file"], input[type="text"]');
            inputs.forEach(function(input) {
                input.value = '';
            });
            imageUploadContainer.appendChild(clone);
            imageUploadContainer.style.display = 'block';
        });
    </script>

</x-app-layout>
