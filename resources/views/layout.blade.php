<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-commence</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js
    "></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
<x-header />

@if(session('success'))
<x-alert type="success" message="{{session('success')}}" />
@endif 

    <main class="container mx-auto p-4 mt-4">
        {{$slot}}
    </main>



</body>
</html>