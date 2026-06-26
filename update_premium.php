<?php
$html = file_get_contents('index.html');
$css = file_get_contents('style.css');
$js = file_get_contents('script.js');

// 1. Preloader
$preloader = <<<HTML
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-content text-center">
            <h2 class="display-4 fw-bolder text-white mb-3 loader-text">Rajesh<span class="text-accent">.</span></h2>
            <div class="loader-bar-container">
                <div class="loader-bar"></div>
            </div>
        </div>
    </div>
HTML;
if (strpos($html, 'id="preloader"') === false) {
    $html = preg_replace('/<body.*?>/', "$0\n" . $preloader, $html, 1);
}

// 2. Color Picker in Navbar
$colorPicker = <<<HTML
            <div class="color-picker dropdown ms-2">
                <button class="btn btn-sm glass-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Change Theme Color">
                    <i class="fas fa-palette"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end glass-card p-2 color-options" style="min-width: 80px;">
                    <li class="mb-1"><button class="dropdown-item color-btn active rounded" data-color="purple" style="background: #7c3aed; height: 30px;" title="Purple"></button></li>
                    <li class="mb-1"><button class="dropdown-item color-btn rounded" data-color="blue" style="background: #0284c7; height: 30px;" title="Blue"></button></li>
                    <li class="mb-1"><button class="dropdown-item color-btn rounded" data-color="emerald" style="background: #10b981; height: 30px;" title="Emerald"></button></li>
                    <li><button class="dropdown-item color-btn rounded" data-color="rose" style="background: #e11d48; height: 30px;" title="Rose"></button></li>
                </ul>
            </div>
HTML;
if (strpos($html, 'id="theme-toggle"') !== false && strpos($html, 'class="color-picker') === false) {
    $html = str_replace('<div class="collapse navbar-collapse"', $colorPicker . "\n            <div class=\"collapse navbar-collapse\"", $html);
}

// 3. Hero Terminal
$html = str_replace('<div class="col-lg-8 col-xl-7 reveal-up">', '<div class="col-lg-6 col-xl-6 reveal-up">', $html);

$terminal = <<<HTML
                <div class="col-lg-6 col-xl-6 reveal-right d-none d-lg-block">
                    <div class="terminal-mockup glass-card rounded-4 overflow-hidden shadow-glow" data-tilt data-tilt-max="5" data-tilt-speed="400" data-tilt-glare data-tilt-max-glare="0.2">
                        <div class="terminal-header d-flex align-items-center px-3 py-2 border-bottom" style="border-color: var(--glass-border) !important; background: rgba(0,0,0,0.2);">
                            <div class="terminal-dots d-flex gap-2">
                                <span class="dot bg-danger rounded-circle" style="width:12px; height:12px;"></span>
                                <span class="dot bg-warning rounded-circle" style="width:12px; height:12px;"></span>
                                <span class="dot bg-success rounded-circle" style="width:12px; height:12px;"></span>
                            </div>
                            <div class="terminal-title mx-auto text-light opacity-75 small font-monospace">developer.php</div>
                        </div>
                        <div class="terminal-body p-4 font-monospace text-start" style="height: 320px; overflow-y: hidden; background: rgba(10, 14, 39, 0.8);">
                            <pre class="m-0"><code id="terminal-typewriter" class="text-light" style="font-size: 0.9rem;"></code></pre>
                        </div>
                    </div>
                </div>
HTML;
if (strpos($html, 'id="terminal-typewriter"') === false) {
    $html = preg_replace('/(<div class="d-flex flex-wrap gap-3">.*?<\/div>\s*<\/div>)/s', "$1\n" . $terminal, $html, 1);
}

// 4. Vanilla Tilt
if (strpos($html, 'vanilla-tilt.min.js') === false) {
    $html = str_replace('<script src="script.js"></script>', '<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>' . "\n    <script src=\"script.js\"></script>", $html);
}

// 5. Project Filtering
$filterBtns = <<<HTML
            <div class="row justify-content-center mb-5 reveal-up">
                <div class="col-12 text-center">
                    <div class="glass-card d-inline-flex p-2 rounded-pill project-filters">
                        <button class="btn btn-sm rounded-pill px-4 filter-btn active" data-filter="all">All</button>
                        <button class="btn btn-sm rounded-pill px-4 filter-btn" data-filter="php">PHP / MVC</button>
                        <button class="btn btn-sm rounded-pill px-4 filter-btn" data-filter="api">API</button>
                        <button class="btn btn-sm rounded-pill px-4 filter-btn" data-filter="frontend">Frontend</button>
                    </div>
                </div>
            </div>
HTML;
if (strpos($html, 'project-filters') === false) {
    $html = preg_replace('/(<div class="title-line mx-auto mt-3"><\/div>\s*<\/div>)/s', "$1\n" . $filterBtns, $html);
}

// Update projects to have data-category
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up" style="transition-delay: 100ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item" data-category="php frontend"> <div class="project-card', $html, 1);
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up" style="transition-delay: 200ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item" data-category="api php"> <div class="project-card', $html, 1);
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up" style="transition-delay: 300ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item" data-category="php frontend"> <div class="project-card', $html, 1);
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up" style="transition-delay: 100ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item" data-category="php api"> <div class="project-card', $html, 1);
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up" style="transition-delay: 200ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item" data-category="php"> <div class="project-card', $html, 1);
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up" style="transition-delay: 300ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item" data-category="api php"> <div class="project-card', $html, 1);
$html = preg_replace('/(<div class="col-lg-4 col-md-6 reveal-up mx-auto" style="transition-delay: 100ms;">\s*<div class="project-card)/', '<div class="col-lg-4 col-md-6 reveal-up project-item mx-auto" data-category="frontend php"> <div class="project-card', $html, 1);

// Add data-tilt to skill and service cards
$html = str_replace('<div class="glass-card h-100 p-4 rounded-4 skill-card">', '<div class="glass-card h-100 p-4 rounded-4 skill-card" data-tilt data-tilt-max="5" data-tilt-speed="400" data-tilt-glare data-tilt-max-glare="0.1">', $html);
$html = str_replace('<div class="service-card glass-card p-5 rounded-4 h-100 text-center">', '<div class="service-card glass-card p-5 rounded-4 h-100 text-center" data-tilt data-tilt-max="5" data-tilt-speed="400">', $html);
$html = str_replace('<div class="project-card glass-card rounded-4 overflow-hidden h-100">', '<div class="project-card glass-card rounded-4 overflow-hidden h-100" data-tilt data-tilt-max="3" data-tilt-speed="400">', $html);

// 7. Contact Form Button Animation
$formBtn = <<<HTML
                                <button type="submit" id="submit-btn" class="btn btn-gradient w-100 py-3 rounded-pill fw-semibold mt-2 position-relative overflow-hidden">
                                    <span class="btn-text"><i class="fas fa-paper-plane me-2"></i> Send Message</span>
                                    <span class="loader-spinner d-none"><i class="fas fa-circle-notch fa-spin"></i> Sending...</span>
                                    <span class="success-msg d-none"><i class="fas fa-check-circle"></i> Sent Successfully!</span>
                                </button>
HTML;
$html = preg_replace('/<button type="submit" class="btn btn-gradient w-100 py-3 rounded-pill fw-semibold mt-2">.*?<\/button>/s', $formBtn, $html);

file_put_contents('index.html', $html);

// CSS Update
$css_additions = <<<CSS

/* Preloader */
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--bg-color);
    z-index: 99999;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}

#preloader.loaded {
    opacity: 0;
    visibility: hidden;
}

.loader-bar-container {
    width: 200px;
    height: 4px;
    background: var(--glass-border);
    border-radius: 4px;
    overflow: hidden;
    margin: 0 auto;
}

.loader-bar {
    width: 0%;
    height: 100%;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    animation: loadBar 2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

@keyframes loadBar {
    0% { width: 0%; }
    50% { width: 70%; }
    100% { width: 100%; }
}

.loader-text {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Color Picker */
.color-picker .dropdown-menu {
    min-width: unset;
}

.color-btn {
    width: 100%;
    border: 2px solid transparent;
    transition: all 0.2s ease;
}

.color-btn:hover {
    transform: scale(1.1);
}

.color-btn.active {
    border-color: var(--text-primary);
    box-shadow: 0 0 10px rgba(255,255,255,0.5);
}

/* Advanced Cursor */
.glow-cursor {
    transition: width 0.3s, height 0.3s, background 0.3s, border 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    color: transparent;
    font-size: 8px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.glow-cursor.hover {
    width: 60px !important;
    height: 60px !important;
    left: calc(var(--x) - 30px) !important;
    top: calc(var(--y) - 30px) !important;
    background: var(--glass-bg);
    backdrop-filter: blur(4px);
    border: 1px solid var(--accent-color) !important;
    color: var(--text-primary);
}

/* Terminal */
.terminal-mockup {
    transform-style: preserve-3d;
    transform: perspective(1000px);
}

#terminal-typewriter .keyword { color: #c678dd; }
#terminal-typewriter .string { color: #98c379; }
#terminal-typewriter .function { color: #61afef; }
#terminal-typewriter .comment { color: #5c6370; font-style: italic; }
#terminal-typewriter .variable { color: #e06c75; }

/* Filter Buttons */
.filter-btn {
    background: transparent;
    color: var(--text-primary);
    border: none;
    transition: all 0.3s ease;
}

.filter-btn:hover, .filter-btn.active {
    background: var(--primary-color);
    color: #fff !important;
}

.project-item {
    transition: all 0.5s ease;
}

.project-item.hide {
    display: none;
}
CSS;

if (strpos($css, '/* Preloader */') === false) {
    file_put_contents('style.css', $css . "\n" . $css_additions);
}

// Update Script.js
$js_additions = <<<JS

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
JS;

$js = preg_replace('/\/\/ Cursor Glow Effect\s*const createGlowCursor = \(\) => \{.*?\};\s*createGlowCursor\(\);/s', $js_additions, $js);

$js_more = <<<JS

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
                root.style.setProperty('--glow-effect', `rgba(\${hexToRgb(theme.primary)}, 0.5)`);
                
                colorBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            }
        });
    });

    function hexToRgb(hex) {
        let result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? 
            `\${parseInt(result[1], 16)}, \${parseInt(result[2], 16)}, \${parseInt(result[3], 16)}` : '124, 58, 237';
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
    <span class="keyword">public</span> <span class="variable">\$name</span> = <span class="string">"Rajesh Jatapara"</span>;
    <span class="keyword">public</span> <span class="variable">\$role</span> = <span class="string">"PHP Expert"</span>;
    
    <span class="keyword">public function</span> <span class="function">buildSolutions</span>() {
        <span class="keyword">return</span> [
            <span class="string">"Scalable APIs"</span>,
            <span class="string">"Complex Databases"</span>,
            <span class="string">"Secure Systems"</span>
        ];
    }
}

<span class="variable">\$rajesh</span> = <span class="keyword">new</span> <span class="function">Developer</span>();
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
JS;

if (strpos($js, 'Theme Color Customizer') === false) {
    $js = preg_replace('/\}\);\s*$/s', $js_more . "\n});", $js);
}
file_put_contents('script.js', $js);

echo "Premium updates completed.\n";
?>
