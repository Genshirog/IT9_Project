<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <link href="{{ asset('font_awesome/css/all.min.css')}}" rel="stylesheet">
</head>
<body class="bg-[#094047]">
    <div class="flex">
        @include('staff.sidebar')
        <div class="flex flex-1 items-center justify-center min-h-screen">
            <div class="w-full max-w-4xl px-6">
                @include('staff.product.form')
            </div>
        </div>
    </div>
</body>
</html>