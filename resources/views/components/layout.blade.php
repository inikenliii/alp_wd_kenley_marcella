<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="stylesheet.css" rel="yaa.css">
        <title>Laravel</title>
        @vite('resources/css/app.css')
    </head>
    <body>

    <div class="min-h-full">
        <x-navigation></x-navigation>
        <x-header>{{$headertitle}}</x-header>
    </div>

        <main>
            <div>
                {{ $slot }}
            </div>
        </main>
</html>