<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zoo Simulator</title>
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body>

    @include('layouts.navbar')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-2 col-md-8 col-md-offset-2 main">
                @yield('content')
            </div>
        </div>

    </div>

    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script>

    $('#feed').on('click', function () {
        var ajaxurl = '{{ route('feed')}}';
        $.ajax({
            url:ajaxurl,
            type:"GET",
            success: function (response) {
                $data = $(response);
                $('#data_table').hide().html($data).fadeIn();
            }
        });
    });

    $('#advanceTime').on('click', function () {
        var dataurl = '{{ route('advanceTime')}}';
        var timeurl = '{{ route('simTime')}}';
        $.ajax({
            url:dataurl,
            type:"GET",
            success: function (response) {
                $data = $(response);
                $('#data_table').hide().html($data).fadeIn();
                $.ajax({
                    url:timeurl,
                    type:"GET",
                    success: function(response) {
                        $('#time').hide().text(response).fadeIn();
                    }
                });
            }
        });

    });

    </script>
    </body>
</html>
