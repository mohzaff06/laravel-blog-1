<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MohZaff Blog</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
</head>
<body class="flex flex-col min-h-screen  bg-radial-[at_10%_10%] from-bg-primary/87 to-bg-primary  text-text-primary">
    <x-navbar/>
    <x-notification/>

    <main class="lg:px-35 md:px-17 sm:px-13 px-3 grow ">
        {{$slot}}
    </main>
    <x-footer/>

</body>
</html>
