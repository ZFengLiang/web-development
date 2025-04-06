<div class="hero-services" style="--hero-bg: url('/assets/img/homepage/barbarshop-indoor.png');">
    <div class="hero-content text-center text-white">
        <h1 class="display-4">Our Services</h1>
        <p class="lead">Explore our full range of grooming services – crafted to make you look and feel your best.</p>
        <a href="/appointment" class="btn btn-outline-light mt-3">Make an Appointment</a>
    </div>
</div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Service Menu</h2>
        <a href="/appointment" class="btn btn-primary">Make an Appointment</a>
    </div>

    <?php foreach ($groupedServices as $category => $services): ?>
        <div class="mb-5">
            <h4 class="fw-bold mb-3"><?= htmlspecialchars($category) ?></h4>
            <ul class="list-group shadow-sm">
                <?php foreach ($services as $service): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?= htmlspecialchars($service['service_name']) ?></div>
                            <small class="text-muted"><?= htmlspecialchars($service['description']) ?></small>
                            <?php if (!empty($service['duration'])): ?>
                                <div class="text-muted small mt-1">
                                    <i class="bi bi-clock"></i> <?= htmlspecialchars($service['duration']) ?> min
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="fw-bold">€<?= number_format($service['price'], 2) ?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
</div>