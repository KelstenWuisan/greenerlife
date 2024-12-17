<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>GreenerLife</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }
        .footer {
            background-color: #2E7D32;
            color: white;
            padding: 10px 0;
            text-align: center;
            margin-top: 30px;
        }
        .main-content {
            padding: 20px;
        }
        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            color: #2E7D32 !important;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-link {
            color: #2E7D32 !important;
        }
        .nav-link:hover {
            color: #388E3C !important;
        }
    </style>
</head>
<body>
    @include('partial.navbar')

    <div class="container main-content">
        @yield('container')
    </div>

    @include('partial.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
