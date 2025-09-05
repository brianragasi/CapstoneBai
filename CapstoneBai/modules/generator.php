<?php
require_once 'modules/functions.php';

// Guard: only handle POSTs from the form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?page=home');
    exit;
}

$language = $_POST['language'] ?? '';
$database = $_POST['database'] ?? '';

$titles = loadTitles('titles.json');
$title = '';
$error = '';

if ($titles === false) {
    $error = 'Could not load titles database.';
} else {
    $result = getCDORelevantTitle($titles, $language, $database);
    if ($result === false) {
        $error = "No titles available for " . formatLanguageName($language) . " + " . formatDatabaseName($database) . ".";
    } else {
        $title = $result;
    }
}
?>

<!-- Results Section -->
<section class="section-tight">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 reveal">
                <div class="card glass-effect border-0 rounded-4 shadow-lg card-hover card-tight">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="feature-icon icon-warning mx-auto mb-3">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <h2 class="hero-title display-6 fw-bold mb-3">
                                🇵🇭 Your CDO Capstone Title
                            </h2>
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger glass-effect border-0 rounded-4 d-flex align-items-center" role="alert">
                                <div class="feature-icon icon-primary me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <strong>Oops!</strong><br>
                                    <?= htmlspecialchars($error) ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card mb-4 border-0 rounded-4 overflow-hidden" style="background: var(--primary-gradient);">
                                <div class="card-body text-center p-4 text-white">
                                    <h4 class="fw-bold mb-3" style="line-height: 1.4;">
                                        <?= htmlspecialchars($title) ?>
                                    </h4>
                                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                                        <span class="tech-badge bg-light text-dark">
                                            <i class="fas fa-code me-1"></i>
                                            <?= htmlspecialchars(formatLanguageName($language)) ?>
                                        </span>
                                        <span class="tech-badge bg-light text-dark">
                                            <i class="fas fa-database me-1"></i>
                                            <?= htmlspecialchars(formatDatabaseName($database)) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <form method="POST" action="index.php?page=generator" class="d-inline">
                                <input type="hidden" name="language" value="<?= htmlspecialchars($language) ?>">
                                <input type="hidden" name="database" value="<?= htmlspecialchars($database) ?>">
                                <button type="submit" class="btn btn-gradient btn-lg px-4 py-3 rounded-pill fw-semibold">
                                    <i class="fas fa-dice me-2"></i>
                                    Generate Another
                                </button>
                            </form>
                            <a href="index.php?page=home" class="btn btn-outline-dark btn-lg px-4 py-3 rounded-pill fw-semibold bg-white">
                                <i class="fas fa-arrow-left me-2"></i>
                                Change Selection
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
