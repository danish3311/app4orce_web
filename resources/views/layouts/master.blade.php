<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-100">

    @include('components.header')

            @if(isset($errorMessage))
            <div class="bg-red-500 text-white py-2 px-4 mb-4">
                {{ $errorMessage }}
            </div>

        @endif

        @if(session('successMessage'))
    <div class="alert alert-success">
        {{ session('successMessage') }}
    </div>
@endif


    @yield('content')

    @include('components.footer')

</body>
</html>
