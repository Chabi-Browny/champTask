<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ChampionshipRegister</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ $baseUrl }}/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="{{ $baseUrl }}/assets/plugins/bootstrap_5_2/css/bootstrap.min.css">

    </head>
    <body>
        <div class="page-wrapper">
            <header>

                @include('pageParts/header')
            </header>
            <main class="content-wrapper">
                @yield('content')
            </main>
            <footer class="content-wrapper">
                @include('pageParts/footer')
            </footer>
        </div>
        @if(!empty($jsPart))
            @include('jsParts/' . $jsPart)
        @endif
    </body>
</html>
