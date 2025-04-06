<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Barbershop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/HomeStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('/assets/img/homepage/barber-outside.png');">
        <div class="container text-center text-white hero-text">
            <h1>Welcome to Clipper BarberShop</h1>
            <p>Your style, our excellence.</p>
            <a href="/appointment" class="btn btn-light">Book an Appointment</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="container-fluid about-section py-5">
        <div class="container">
            <h2 class="mb-3 text-center">About Us</h2>
            <hr class="about-divider mx-auto mb-4">
            <div class="about-intro mx-auto mb-5 text-center">
                <p>
                    At My Barbershop, we provide top-notch haircuts, shaves, and grooming services.
                    Our team of professional barbers is dedicated to giving you the best experience
                    in a clean, stylish, and welcoming environment.
                </p>
            </div>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <img src="/assets/img/homepage/barber1.png" class="img-fluid rounded shadow" alt="Barber 1">
                    <p class="mt-2">Jason has over 10 years of experience and specializes in modern fades and precision styling.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="/assets/img/homepage/barber2.png" class="img-fluid rounded shadow" alt="Barber 2">
                    <p class="mt-2">Maria is known for her attention to detail and creative cuts that bring out each client’s personality.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="/assets/img/homepage/barber3.png" class="img-fluid rounded shadow" alt="Barber 3">
                    <p class="mt-2">Alex brings energy and style to every cut, with a reputation for friendly service and sharp results.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
        <div class="container-fluid service-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="mb-2">Our Services</h2>
                <hr class="services-divider mx-auto mb-3">
                <div class="services-intro mx-auto mb-4 text-center">
                <p>
                At Clipper Barbershop, we take pride in delivering quality grooming tailored to your unique style.
                From sharp haircuts to precision beard trims and relaxing shaves, our services are designed 
                to help you look and feel your best with every visit.
                </p>
        </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <img src="/assets/img/homepage/haircut.png" class="img-fluid rounded shadow" alt="Haircut service">
                    <h3 class="mt-3">Haircut</h3>
                    <p>Professional and stylish haircuts for all hair types.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="/assets/img/homepage/beard-trim.png" class="img-fluid rounded shadow" alt="Beard Trim service">
                    <h3 class="mt-3">Beard Trim</h3>
                    <p>Keep your beard neat and tidy with our expert trimming services.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="/assets/img/homepage/shave.png" class="img-fluid rounded shadow" alt="Shaving service">
                    <h3 class="mt-3">Shaves</h3>
                    <p>Smooth, clean shaves to keep you looking sharp and fresh.</p>
                </div>
            </div>
        </div>
    </div>

   <!-- Location Section -->
    <div class="container my-5">
        <div class="row align-items-center">
            <!-- Map -->
            <div class="col-md-8 mb-4 mb-md-0">
                <div class="map-responsive">
                    <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243646.66307898358!2d4.7284204!3d52.3784054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c609c8b5e5e5f3%3A0x6e50a65e013b83ea!2sAmsterdam%2C%20Netherlands!5e0!3m2!1sen!2snl!4v1712345678901!5m2!1sen!2snl"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

        <!-- Button Card -->
        <div class="col-md-4">
            <div class="p-4 bg-light shadow rounded text-center h-100 d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <i class="bi bi-calendar2-check" style="font-size: 2rem; color: #007bff;"></i>
                </div>
                <h5 class="mb-2">Visit Us</h5>
                <p>123 Main Street, Amsterdam</p>
                <a href="https://www.google.com/maps/dir/?api=1&destination=123+Main+Street+Amsterdam" target="_blank" class="btn btn-primary">
                    Get Directions
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
