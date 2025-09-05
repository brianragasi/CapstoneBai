<!-- Hero Section -->
<section class="section-tight">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card glass-effect card-hover border-0 rounded-4 shadow-lg card-tight reveal">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h1 class="hero-title display-5 fw-bold mb-3">CapstoneBai</h1>
                            <p class="text-muted lead">Generate capstone titles for Cagayan de Oro City using our AI-powered system</p>
                        </div>
                        
                        <form method="POST" action="index.php?page=generator" class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="language" class="form-label fw-semibold">Programming Language</label>
                                    <select name="language" id="language" class="form-select form-select-lg border-0 glass-effect" required>
                                        <option value="">Choose a language...</option>
                                        <option value="PHP">PHP - Web Development</option>
                                        <option value="Python">Python - Data Science & AI</option>
                                        <option value="Java">Java - Enterprise Solutions</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="database" class="form-label fw-semibold">Database</label>
                                    <select name="database" id="database" class="form-select form-select-lg border-0 glass-effect" required>
                                        <option value="">Choose a database...</option>
                                        <option value="MySQL">MySQL - Relational Database</option>
                                        <option value="MongoDB">MongoDB - NoSQL Database</option>
                                        <option value="SQLite">SQLite - Lightweight Database</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-gradient btn-lg px-5 py-3 rounded-pill fw-semibold">
                                        <i class="fas fa-magic me-2"></i>Generate Title
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col">
                <h2 class="display-6 fw-bold text-white mb-3 reveal">Why Choose My Generator?</h2>
                <p class="text-white-50 lead reveal">Discover the features that make my capstone title generator unique</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card glass-effect border-0 rounded-4 shadow-lg card-hover h-100 card-tight reveal">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon icon-primary mx-auto">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3">CDO-Focused</h4>
                        <p class="text-muted">Specifically designed for Cagayan de Oro City with local relevance and context</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card glass-effect border-0 rounded-4 shadow-lg card-hover h-100 card-tight reveal">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon icon-success mx-auto">
                            <i class="fas fa-random"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Smart Generator</h4>
                        <p class="text-muted">Intelligent algorithms curate and generate realistic capstone project titles from My database</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card glass-effect border-0 rounded-4 shadow-lg card-hover h-100 card-tight reveal">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon icon-warning mx-auto">
                            <i class="fas fa-code"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Tech-Specific</h4>
                        <p class="text-muted">Tailored titles based on your chosen programming language and database</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
