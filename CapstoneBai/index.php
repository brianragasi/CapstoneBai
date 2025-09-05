<?php
// Main router - Single entry point for all pages
// Get the requested page from URL parameter, default to 'home'
$page = $_GET['page'] ?? 'home';

// Validate and sanitize the page parameter
$allowedPages = ['home', 'about', 'generator'];
if (!in_array($page, $allowedPages)) {
    $page = 'home'; // Default fallback
}

// Set page-specific variables
$pageTitle = '';
$activeHome = '';
$activeAbout = '';

switch ($page) {
    case 'home':
        $pageTitle = 'Capstone Generator for Cagayan de Oro City';
        $activeHome = 'active';
        break;
    case 'about':
        $pageTitle = 'About Me | Capstone Generator for CDO';
        $activeAbout = 'active';
        break;
    case 'generator':
        $pageTitle = 'Your Capstone Title | CDO Generator';
        break;
    default:
        $pageTitle = 'Capstone Generator for Cagayan de Oro City';
        $activeHome = 'active';
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Modern Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-blur">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php?page=home">
                <i class="fas fa-graduation-cap me-2"></i>
                Capstone Generator for CDO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium <?= $activeHome ?>" href="index.php?page=home">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium <?= $activeAbout ?>" href="index.php?page=about">
                            <i class="fas fa-user me-1"></i>About Me
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main>
        <?php
        // Include the requested page content
        switch ($page) {
            case 'home':
                include 'modules/home.php';
                break;
            case 'about':
                include 'modules/about.php';
                break;
            case 'generator':
                include 'modules/generator.php';
                break;
            default:
                include 'modules/home.php';
                break;
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="site-footer py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="text-white-50">© <?= date('Y') ?> CDO Capstone Title Generator</span>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="text-white-50">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        Crafted in Cagayan de Oro City
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/script.js"></script>
    
    <!-- Form Validation (only for home page) -->
    <?php if ($page === 'home'): ?>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <?php endif; ?>
</body>
</html>
