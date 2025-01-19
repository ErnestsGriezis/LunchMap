<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>@yield('title', 'LunchMap')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <!-- Load Google Maps AFTER app.js is ready -->
    <script>
        window.addEventListener("load", () => {
            const googleMapsScript = document.createElement("script");
            googleMapsScript.src =
                "https://maps.googleapis.com/maps/api/js?key=AIzaSyA1c7D7QciXP1xuFZdJQ_cWMKUxoyvTSSg&libraries=places&callback=initMap";
            googleMapsScript.async = true;
            googleMapsScript.defer = true;
            document.body.appendChild(googleMapsScript);
        });
    </script>
</head>

<body class="d-flex flex-column min-vh-100">
    <!--Navbar -->
    @include('navbar')

    <!-- Main Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>
    @include('places.createPlace')

    <!-- Footer -->
    @include('footer')


</body>

</html>
