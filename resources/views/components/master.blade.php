<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Tweety') }}</title>

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
        <!-- jQuery library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    -->
    <!-- Latest compiled JavaScript 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    -->
    <!-- disable a toast -->
    <script>
    function myDisable() {
    document.getElementById("alert_toast").style.display="none";
    }
    </script>
     
    <!-- Styles 
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    -->
    @livewireStyles
</head>
<body>
<div id="app">
    <section class="px-8 py-4 mb-6">
        <header class="container mx-auto">
            <h1>
                <img
                    src="/images/logo.svg"
                    alt="Tweety"
                >
            </h1>
        </header>
    </section>
    
    {{ $slot }}
</div>
@livewireScripts
</body>
    <!--<script src="http://unpkg.com/turbolinks"></script>-->
    <script>
    var maxCharacters = 400;
    $('#characterLeft').text(maxCharacters + ' characters left');
    $('#comment_tweet').keyup(function () {
        var textLength =$(this).val().length;
        if (textLength >= maxCharacters) {
            $('#characterLeft').text('You have reached the limit of ' + maxCharacters + ' characters');
        } else {
            var count = maxCharacters - textLength;
            $('#characterLeft').text(count + ' characters left');
        }
    });
    </script>
</html>