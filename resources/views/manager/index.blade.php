<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('css/index.css')}}">


    <!-- Styles -->

</head>
<body>

<div class="container-fluid p-3">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between text-center">
            <div>
                <img src="{{ asset('svg/square.svg') }}">
            </div>

            <div class="d-flex flex-wrap text-center">
                <div class="p-2">
                    <form action="{{ route('file.create') }}" method="post" enctype="multipart/form-data"
                          id="fileUploadForm">
                        @csrf

                        <!-- Hidden file input -->
                        <input type="file" id="fileUploadInput" name="file" style="display:none">

                        <!-- Image that triggers file input on click -->
                        <label for="fileUploadInput" style="cursor: pointer;">
                            <img src="{{ asset('svg/upload.svg') }}" alt="Upload File">
                        </label>

                    </form>
                </div>
                <div class="p-2">
                    <a href="#" id="globalDownload">
                        <img src="{{asset('svg/download.svg')}}">
                    </a>
                </div>
                <div class="p-2">
                    <a href="#" id="globalDelete">
                        <img src="{{asset('svg/delete.svg')}}">
                    </a>
                </div>
            </div>
            <div>
                <img src="{{ asset('svg/close.svg') }}">

            </div>

        </div>
    </div>
    <div class="container mt-4">
        <div class="d-flex flex-wrap">
            @foreach($files as $file)
                <div class="px-2 col-md-4 col-12 text-center">
                    <div class="fileBlock" data-id="{{$file['id']}}">
                        <div class="d-flex justify-content-between flex-wrap  additionalBlock">
                            <div class="p-1 conf " style="cursor: pointer;">
                                <img src="{{ asset('svg/conf.svg') }}">
                            </div>
                            <a href="{{route('file.delete',$file['id'])}}">
                                <div class="p-1">
                                    <img src="{{ asset('svg/decl.svg') }}">
                                </div>
                            </a>
                        </div>

                        <img src="{{asset('svg/file.svg')}}" class="mt-3">


                        <p class="mt-3" style="hyphens: auto;">
                            {{ pathinfo($file['path'], PATHINFO_FILENAME) }}
                        </p>

                        <div class="mt-2 additionalBlock">
                            <a href="{{route('file.download',$file['id'])}}">
                                <img src="{{asset('svg/download_type_2.svg')}}" width="32px" height="32px">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Listen for change event on file input
        $('#fileUploadInput').change(function () {
            // Automatically submit the form when a file is selected
            $('#fileUploadForm').submit();
        });
        $('.fileBlock').click(function () {
            event.stopPropagation();

            $('.additionalBlock').removeClass('active');
            // Remove 'active' class from all other .fileBlock elements
            $('.fileBlock').not(this).removeClass('active');

            // Toggle 'active' class on the clicked .fileBlock element
            $(this).toggleClass('active');

            // Toggle the visibility of the .additionalBlock based on 'active' class presence
            var additionalBlock = $(this).find('.additionalBlock');
            additionalBlock.toggleClass('active', $(this).hasClass('active'));

            // Add .clickable class to all <a> elements within .additionalBlock

            var fileId = $(this).data('id');


            $('#globalDelete').attr('href', $('.fileBlock.active').length ? "{{ route('file.delete', '') }}/" + fileId : '#');
            $('#globalDownload').attr('href', $('.fileBlock.active').length ? "{{ route('file.download', '') }}/" + fileId : '#');


        });
        $('.conf').click(function () {
            event.stopPropagation();
            $('.additionalBlock').removeClass('active');


            // Remove 'active' class from all .fileBlock elements
            $('.fileBlock').removeClass('active');
        });

    });
</script>
</html>
