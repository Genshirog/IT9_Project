<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <script src="{{ asset('js/alpine.min.js') }}" defer></script>
    <link href="{{ asset('font_awesome/css/all.min.css')}}" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-[#fef8f8]">
    @include('customer.navbar')
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-7xl p-6" x-data="{ openModal: false }"> <!-- Alpine data for the modal state -->
            @if ($OrderItems->isEmpty())
                <div class="p-4">
                        <p class="text-center text-gray-500">Your cart is empty.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>