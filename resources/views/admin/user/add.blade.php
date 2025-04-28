<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-[#094047]">
    <div class="flex">
        @include('admin.sidebar')
        <div class="flex-1 items-center justify-center min-h-screen">
            <h1>Add Staff</h1>
            <form action="#" method="POST" class="bg-black/30 p-8 rounded shadow-md backdrop-blur-sm">
                @csrf
                <label>Firstname</label>
                <input type="text" name="" id="">
                <label>Lastname</label>
                <input type="text" name="" id="">
                <label>Address</label>
                <input type="text" name="" id="">
                <label>Email</label>
                <input type="email" name="" id="">
                <label>ContactNumber</label>
                <input type="text" name="" id="">
                <label>Username</label>
                <input type="text" name="" id="">
                <label>Password</label>
                <input type="password" name="" id="">
            </form>
        </div>
    </div>
</body>
</html>