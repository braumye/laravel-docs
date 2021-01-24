<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ isset($title) ? $title . ' - ' : null }}Laravel - The PHP Framework For Web Artisans</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/vendor/docs/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/vendor/docs/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/vendor/docs/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/vendor/docs/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/vendor/docs/img/favicon/safari-pinned-tab.svg" color="#ff2d20">
    <link rel="shortcut icon" href="/vendor/docs/img/favicon/favicon.ico">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://use.typekit.net/ins2wgm.css">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css', 'vendor/docs') }}">
</head>
<body
    x-data="{
        navIsOpen: false,
        searchIsOpen: false,
        search: '',
    }"
    class="language-php h-full w-full font-sans text-gray-900 antialiased"
>

@yield('content')

<script src="{{ mix('js/app.js', 'vendor/docs') }}"></script>
</body>
</html>
