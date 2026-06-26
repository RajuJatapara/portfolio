document.addEventListener('DOMContentLoaded', () => {
    
    // Set Current Year in Footer
    const yearEl = document.getElementById('current-year');
    if(yearEl) yearEl.textContent = new Date().getFullYear();

    // ===== SCROLL PROGRESS BAR =====
    const scrollProgressBar = document.getElementById('scroll-progress-bar');
    window.addEventListener('scroll', () => {
        const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (window.scrollY / windowHeight) * 100;
        if (scrollProgressBar) {
            scrollProgressBar.style.width = scrolled + '%';
        }
    });

    // ===== THEME TOGGLE =====
    const themeToggle = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;
    
    // Check for saved theme preference or default to dark mode
    const savedTheme = localStorage.getItem('portfolio-theme') || 'dark';
    if (savedTheme === 'light') {
        document.body.classList.add('light-mode');
        themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    }
    
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('light-mode');
        const isLightMode = document.body.classList.contains('light-mode');
        localStorage.setItem('portfolio-theme', isLightMode ? 'light' : 'dark');
        themeToggle.innerHTML = isLightMode ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    });

    // ===== FLOATING PARTICLES =====
    const particlesContainer = document.getElementById('particles-container');
    const particleCount = window.innerWidth > 768 ? 50 : 25;
    
    function createParticles() {
        particlesContainer.innerHTML = '';
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 100 + 20;
            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;
            const duration = Math.random() * 20 + 30;
            const delay = Math.random() * 5;
            
            particle.style.cssText = `
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                opacity: ${Math.random() * 0.5 + 0.1};
                animation: float-particle ${duration}s linear ${delay}s infinite;
            `;
            
            particlesContainer.appendChild(particle);
        }
    }
    
    createParticles();
    
    // Recreate particles on window resize
    window.addEventListener('resize', () => {
        createParticles();
    });

    
    // Preloader
    const preloader = document.getElementById('preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                preloader.classList.add('loaded');
            }, 2000);
        });
    }

    // Advanced Cursor Update
    const createAdvancedCursor = () => {
        const glowCursor = document.createElement('div');
        glowCursor.className = 'glow-cursor';
        glowCursor.style.cssText = `
            position: fixed;
            width: 30px;
            height: 30px;
            border: 2px solid var(--primary-color);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            box-shadow: 0 0 15px var(--glow-effect);
            display: none;
            pointer-events: none;
        `;
        document.body.appendChild(glowCursor);
        
        document.addEventListener('mousemove', (e) => {
            glowCursor.style.display = 'flex';
            glowCursor.style.setProperty('--x', e.clientX + 'px');
            glowCursor.style.setProperty('--y', e.clientY + 'px');
            if(!glowCursor.classList.contains('hover')) {
                glowCursor.style.left = (e.clientX - 15) + 'px';
                glowCursor.style.top = (e.clientY - 15) + 'px';
            }
        });
        
        document.addEventListener('mouseleave', () => {
            glowCursor.style.display = 'none';
        });

        // Add hover effect to links and buttons
        const interactables = document.querySelectorAll('a, button, .project-card, .skill-card');
        interactables.forEach(el => {
            el.addEventListener('mouseenter', () => {
                glowCursor.classList.add('hover');
                glowCursor.innerText = 'View';
            });
            el.addEventListener('mouseleave', () => {
                glowCursor.classList.remove('hover');
                glowCursor.innerText = '';
            });
        });
    };
    createAdvancedCursor();

    // Sticky Navbar with Enhanced Effects
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Custom Scrollspy & Smooth Scrolling
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    const navbarHeight = navbar ? navbar.offsetHeight : 80;

    // Smooth scroll on nav link click
    navLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href");
            
            // Only handle internal anchor links
            if (targetId.startsWith("#")) {
                e.preventDefault();
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - navbarHeight,
                        behavior: "smooth"
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.getElementById('navbarNav');
                    if(navbarCollapse.classList.contains('show')) {
                        const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                        if(bsCollapse) bsCollapse.hide();
                    }
                }
            }
        });
    });

    // Update active nav link on scroll
    window.addEventListener("scroll", () => {
        let current = "";
        const scrollY = window.pageYOffset;

        sections.forEach((section) => {
            const sectionHeight = section.offsetHeight;
            const sectionTop = section.offsetTop - navbarHeight - 50; // offset for earlier trigger
            
            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                current = section.getAttribute("id");
            }
        });

        // Special case for bottom of page (Contact section)
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
            current = sections[sections.length - 1].getAttribute("id");
        }

        navLinks.forEach((link) => {
            link.classList.remove("active");
            if (link.getAttribute("href") === `#${current}`) {
                link.classList.add("active");
            }
        });
    });


    // Typing Effect
    const typedTextSpan = document.querySelector(".typed-text");
    if(typedTextSpan) {
        const textArray = ["PHP Developer", "Backend Engineer", "API Specialist", "Problem Solver"];
        const typingDelay = 100;
        const erasingDelay = 50;
        const newTextDelay = 2000;
        let textArrayIndex = 0;
        let charIndex = 0;

        function type() {
            if (charIndex < textArray[textArrayIndex].length) {
                typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
                charIndex++;
                setTimeout(type, typingDelay);
            } else {
                setTimeout(erase, newTextDelay);
            }
        }

        function erase() {
            if (charIndex > 0) {
                typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex - 1);
                charIndex--;
                setTimeout(erase, erasingDelay);
            } else {
                textArrayIndex++;
                if (textArrayIndex >= textArray.length) textArrayIndex = 0;
                setTimeout(type, typingDelay + 1100);
            }
        }

        if (textArray.length) setTimeout(type, newTextDelay + 250);
    }

    // Scroll Reveal Animation
    const revealElements = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right');
    
    const revealOptions = {
        threshold: 0.1,
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

    // Animated Counters with Smooth Effect
    const counters = document.querySelectorAll('.counter');
    let hasCounted = false;

    const counterOptions = {
        threshold: 0.5
    };

    const counterObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasCounted) {
                counters.forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-target');
                        let count = +counter.innerText;
                        
                        const increment = target / 40;

                        if (count < target) {
                            count += increment;
                            counter.innerText = Math.ceil(count);
                            counter.style.color = 'var(--primary-color)';
                            counter.style.textShadow = '0 0 10px var(--glow-effect)';
                            setTimeout(updateCount, 30);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                });
                hasCounted = true;
                observer.unobserve(entry.target);
            }
        });
    }, counterOptions);

    const statsSection = document.querySelector('.statistics-section');
    if (statsSection) {
        counterObserver.observe(statsSection);
    }

    // Back to Top Button
    const backToTopBtn = document.getElementById('back-to-top');
    if(backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('active');
            } else {
                backToTopBtn.classList.remove('active');
            }
        });
        
        backToTopBtn.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
    }

    // Theme Color Customizer
    const colorBtns = document.querySelectorAll('.color-btn');
    const root = document.documentElement;
    
    const themes = {
        'purple': { primary: '#7c3aed', secondary: '#6d28d9', accent: '#06b6d4' },
        'blue': { primary: '#0284c7', secondary: '#0369a1', accent: '#8b5cf6' },
        'emerald': { primary: '#10b981', secondary: '#059669', accent: '#3b82f6' },
        'rose': { primary: '#e11d48', secondary: '#be123c', accent: '#f59e0b' }
    };

    colorBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const color = btn.getAttribute('data-color');
            const theme = themes[color];
            
            if(theme) {
                root.style.setProperty('--primary-color', theme.primary);
                root.style.setProperty('--secondary-color', theme.secondary);
                root.style.setProperty('--accent-color', theme.accent);
                root.style.setProperty('--glow-effect', `rgba(${hexToRgb(theme.primary)}, 0.5)`);
                
                colorBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }
        });
    });

    function hexToRgb(hex) {
        let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? 
            `${parseInt(result[1], 16)}, ${parseInt(result[2], 16)}, ${parseInt(result[3], 16)}` : '124, 58, 237';
    }

    // Project Filtering
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filterValue = btn.getAttribute('data-filter');
            
            projectItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category').includes(filterValue)) {
                    item.classList.remove('hide');
                    setTimeout(() => item.style.opacity = '1', 50);
                } else {
                    item.style.opacity = '0';
                    setTimeout(() => item.classList.add('hide'), 300);
                }
            });
        });
    });

    // Terminal Typing Effect
    const terminalEl = document.getElementById('terminal-typewriter');
    if (terminalEl) {
        const codeText = `
<span class="comment">// Backend Developer Profile</span>
<span class="keyword">class</span> <span class="function">Developer</span> {
    <span class="keyword">public</span> <span class="variable">$name</span> = <span class="string">"Rajesh Jatapara"</span>;
    <span class="keyword">public</span> <span class="variable">$role</span> = <span class="string">"PHP Expert"</span>;
    
    <span class="keyword">public function</span> <span class="function">buildSolutions</span>() {
        <span class="keyword">return</span> [
            <span class="string">"Scalable APIs"</span>,
            <span class="string">"Complex Databases"</span>,
            <span class="string">"Secure Systems"</span>
        ];
    }
}

<span class="variable">$rajesh</span> = <span class="keyword">new</span> <span class="function">Developer</span>();
<span class="keyword">echo</span> <span class="string">"Ready to code!"</span>;
        `.trim();
        
        // Wait for preloader
        setTimeout(() => {
            let i = 0;
            // Since it contains HTML tags, we type char by char but process tags instantly
            let isTag = false;
            let text = "";
            
            function typeCode() {
                if (i < codeText.length) {
                    let char = codeText.charAt(i);
                    text += char;
                    terminalEl.innerHTML = text;
                    
                    if (char === '<') isTag = true;
                    if (char === '>') isTag = false;
                    
                    i++;
                    setTimeout(typeCode, isTag ? 0 : 20); // Fast typing for tags
                }
            }
            typeCode();
        }, 2500);
    }

    // Contact Form Animation
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const btn = document.getElementById('submit-btn');
            const text = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.loader-spinner');
            const success = btn.querySelector('.success-msg');
            
            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            
            setTimeout(() => {
                spinner.classList.add('d-none');
                success.classList.remove('d-none');
                btn.classList.add('bg-success');
                btn.style.background = '#10b981';
                contactForm.reset();
                
                setTimeout(() => {
                    success.classList.add('d-none');
                    text.classList.remove('d-none');
                    btn.classList.remove('bg-success');
                    btn.style.background = '';
                }, 3000);
            }, 2000);
        });
    }
});