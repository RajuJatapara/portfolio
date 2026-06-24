document.addEventListener('DOMContentLoaded', () => {
    // Set current year in footer
    const yearEl = document.getElementById('year');
    if(yearEl) yearEl.textContent = new Date().getFullYear();

    // Navbar Scrolled Effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth Scrolling & Mobile Menu Auto-Close
    document.querySelectorAll('a.nav-link, a.btn').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            // If it's a page link (e.g. index.php#about) and we're on index.php, parse the hash
            let targetHash = targetId;
            if(targetId.includes('#')) {
                targetHash = '#' + targetId.split('#')[1];
            }

            if(targetHash && targetHash.startsWith('#')) {
                const targetElement = document.querySelector(targetHash);
                if(targetElement) {
                    e.preventDefault();
                    // Close mobile menu if open
                    const navbarCollapse = document.getElementById('navbarNav');
                    if(navbarCollapse && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                        bsCollapse.hide();
                    }
                    
                    // Scroll to target
                    const offset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - offset;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                    
                    // Update URL silently
                    history.pushState(null, null, targetHash);
                }
            }
        });
    });

    // Typing Effect Animation
    const typedTextElement = document.getElementById('typed-text');
    if (typedTextElement) {
        const words = ["Full Stack PHP Developer", "Laravel Expert", "API Architect", "Problem Solver"];
        let i = 0;
        let isDeleting = false;
        let txt = '';
        let speed = 100;

        function typeWriter() {
            const currentWord = words[i];
            
            if (isDeleting) {
                txt = currentWord.substring(0, txt.length - 1);
                speed = 40;
            } else {
                txt = currentWord.substring(0, txt.length + 1);
                speed = 80;
            }

            typedTextElement.textContent = txt;

            if (!isDeleting && txt === currentWord) {
                speed = 2500; // Pause at end of word
                isDeleting = true;
            } else if (isDeleting && txt === '') {
                isDeleting = false;
                i = (i + 1) % words.length;
                speed = 500; // Pause before new word
            }

            setTimeout(typeWriter, speed);
        }
        
        setTimeout(typeWriter, 1000);
    }

    // Scroll Reveal Animation (Intersection Observer)
    const revealElements = document.querySelectorAll('.reveal');
    
    const revealOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px"
    };

    const revealOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, revealOptions);

    revealElements.forEach(el => {
        revealOnScroll.observe(el);
    });

    // Form Validation Simulation
    const form = document.getElementById('contactForm');
    if (form) {
        const submitBtn = document.getElementById('submitBtn');
        const toastEl = document.getElementById('successToast');
        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            event.stopPropagation();

            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }

            // Simulate sending process
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...';
            submitBtn.disabled = true;

            setTimeout(() => {
                form.reset();
                form.classList.remove('was-validated');
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
                toast.show();
            }, 1500);
        }, false);
    }
});
