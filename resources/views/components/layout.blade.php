<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="stylesheet.css" rel="yaa.css">
        <title>{{  $headerTitle }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="{{ $bgColor }}">

        <main>
            <div>
                {{ $slot }}
            </div>
        </main>
        
    </body>
</html>