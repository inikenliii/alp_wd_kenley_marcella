<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="stylesheet.css" rel="yaa.css">
        <title>{{ $headertitle }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="{{ $bgColor }}">

    <div class="min-h-full">
        <x-navbar></x-navbar>
        <x-header>{{ $headertitle }}</x-header>
    </div>

        <main>
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
</html>
