<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }} - MultiVendor Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/admin.css" rel="stylesheet">


</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <!-- NAVBAR -->
            <x-admin.side-bar />

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <!-- Top Navbar -->
                <x-admin.top-navbar />

                <!-- Cards -->
                 {{ $slot }}
                
                <!-- Table -->
                

            </main>


           





        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
