<?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section id="home" class="min-vh-100 d-flex align-items-center hero-section position-relative overflow-hidden mt-n5 pt-5">
        <div class="bg-shape-1"></div>
        <div class="bg-shape-2"></div>
        <div class="container position-relative z-1">
            <div class="row align-items-center pt-5">
                <div class="col-lg-8 col-xl-7 reveal-up">
                    <div class="badge-glass mb-4 d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mt-4">
                        <span class="status-dot blink"></span>
                        <span class="text-light fw-medium">Available for work</span>
                    </div>
                    <h1 class="display-3 fw-bolder text-white mb-3">
                        Hi, I'm <br>
                        <span class="text-gradient">Rajesh Jatapara</span>
                    </h1>
                    <h2 class="fs-2 text-white-50 mb-4" style="min-height: 48px;">
                        <span class="typed-text"></span><span class="cursor">&nbsp;</span>
                    </h2>
                    <p class="fs-5 text-light mb-5 max-w-lg opacity-75">
                        I specialize in building scalable web applications, RESTful APIs, and complex backend architectures using PHP and modern frontend technologies. With 3+ years of experience crafting digital solutions.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#contact" class="btn btn-gradient px-4 py-3 rounded-pill fw-semibold">
                            <i class="fas fa-paper-plane me-2"></i> Contact Me
                        </a>
                        <a href="#projects" class="btn btn-glass px-4 py-3 rounded-pill fw-semibold">
                            <i class="fas fa-laptop-code me-2"></i> View Projects
                        </a>
                        <a href="resume.html" target="_blank" class="btn btn-glass px-4 py-3 rounded-pill fw-semibold">
                            <i class="fas fa-download me-2"></i> Download Resume
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'sections/about.php'; ?>
    <?php include 'sections/skills.php'; ?>
    <?php include 'sections/experience.php'; ?>
    <?php include 'sections/projects.php'; ?>
    <?php include 'sections/services.php'; ?>
    <?php include 'sections/contact.php'; ?>

<?php include 'includes/footer.php'; ?>
