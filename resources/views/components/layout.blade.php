<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/assets/js/jquery.min.js"></script>


    <!-- Bootstrap 5 CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/aos.css" rel="stylesheet">


    <style>
        body {
            background-color: #f8f9fa;
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }

        .vendor-card {
            transition: 0.3s;
        }

        .vendor-card:hover {
            transform: translateY(-5px);
        }

        .carousel-item img {
            height: 100vh;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                height: 250px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <x-navbar />


    {{ $slot }}


    <!-- HERO CAROUSEL -->



    <!-- CATEGORIES -->



    <!-- FEATURED PRODUCTS -->



    <!-- TOP VENDORS -->



    <!-- FOOTER -->
    <x-footer />

    <!-- Bootstrap JS -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script>
        AOS.init();
    </script>


</body>

</html>
