<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { margin: 0; min-height: 100vh; display: flex; flex-direction: column; background-color: #eef6ff; }
        .content-wrapper { flex: 1; position: relative; }
    </style>
</head>
<body>
@include('layouts.partials.navbar')

<div class="content-wrapper">
    @yield('content')
</div>

@include('layouts.partials.footer')
</body>
</html>