<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Clipper</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Always visible links -->
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/service">Services</a>
                </li>
                <!-- Dashboard only visible when logged in -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Right side -->
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="nav-link text-white me-2">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </span>
                    <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-primary btn-sm">Login / Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>