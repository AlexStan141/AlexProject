<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Document</title>
</head>

<body class="flex flex-col min-h-screen">
    <x-header></x-header>
    <main class="flex flex-1">
        <x-navigation class="basis-1/5" :$active></x-navigation>
        <x-dashboard class="basis-4/5">
            {{ $slot }}
        </x-dashboard>
    </main>
</body>

</html>
