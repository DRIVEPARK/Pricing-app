<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
      rel="stylesheet"
      href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css"
    />
        <title>Pricing App</title>

    </head>
    <body class="antialiased">

       <div id="app"></div>
       @vite('resources/js/app.js')
    </body>
</html>
