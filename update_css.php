<?php
$css = file_get_contents('style.css');

$vars_block = <<<EOT
/* CSS Variables for Premium Modern Theme */
:root {
    --bg-color: #0a0e27;
    --bg-gradient: linear-gradient(135deg, #0a0e27 0%, #1a0a2e 50%, #0f0620 100%);
    --primary-color: #7c3aed;
    --secondary-color: #6d28d9;
    --accent-color: #06b6d4;
    --accent-secondary: #ec4899;
    
    /* Text Colors */
    --text-primary: #f8fafc;
    --text-secondary: #cbd5e1;
    --text-muted: #94a3b8;
    --text-inverse: #0f172a;
    
    /* Glassmorphism */
    --glass-bg: rgba(30, 41, 59, 0.4);
    --glass-border: rgba(255, 255, 255, 0.1);
    --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
    
    --nav-glass: rgba(10, 14, 39, 0.7);
    --nav-glass-scrolled: rgba(10, 14, 39, 0.95);
    
    --glow-effect: rgba(124, 58, 237, 0.5);
    
    --font-heading: 'Outfit', sans-serif;
    --font-body: 'Inter', sans-serif;
}

/* Light Mode Theme */
body.light-mode {
    --bg-color: #f8fafc;
    --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
    --primary-color: #6d28d9;
    --secondary-color: #ede9fe;
    --accent-color: #0284c7;
    --accent-secondary: #db2777;
    
    /* Text Colors */
    --text-primary: #0f172a;
    --text-secondary: #334155;
    --text-muted: #64748b;
    --text-inverse: #f8fafc;
    
    /* Glassmorphism */
    --glass-bg: rgba(255, 255, 255, 0.7);
    --glass-border: rgba(255, 255, 255, 0.5);
    --glass-shadow: 0 8px 32px 0 rgba(30, 41, 59, 0.08);
    
    --nav-glass: rgba(248, 250, 252, 0.8);
    --nav-glass-scrolled: rgba(255, 255, 255, 0.95);
    
    --glow-effect: rgba(124, 58, 237, 0.3);
}

/* Bootstrap Theme Overrides */
.text-white, .text-light, body .text-white, body .text-light { color: var(--text-primary) !important; }
.text-white-50, body .text-white-50 { color: var(--text-muted) !important; }
.opacity-75 { opacity: 1 !important; color: var(--text-secondary) !important; }
h1, h2, h3, h4, h5, h6 { color: var(--text-primary) !important; }
p { color: var(--text-secondary) !important; }
EOT;

$css = preg_replace('/\\/\\* CSS Variables for Premium Modern Theme \\*\\/.*?\\/\\* Base Styles \\*\\//s', $vars_block . "\n\n/* Base Styles */", $css);

$css = preg_replace('/body:not\(\.light-mode\)\s*\{.*?\}/s', "body:not(.light-mode) {\n    background: var(--bg-gradient);\n}", $css);
$css = preg_replace('/body\.light-mode\s*\{.*?\}/s', "body.light-mode {\n    background: var(--bg-gradient) !important;\n}", $css);

$nav_glass = <<<EOT
.glass-nav {
    background: var(--nav-glass);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--glass-border);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.glass-nav.scrolled {
    background: var(--nav-glass-scrolled);
    box-shadow: var(--glass-shadow);
    border-bottom-color: var(--glass-border);
}
EOT;

$css = preg_replace('/\.glass-nav\s*\{.*?\}/s', $nav_glass, $css);
$css = preg_replace('/body\.light-mode \.glass-nav\s*\{.*?\}/s', '', $css);
$css = preg_replace('/\.glass-nav\.scrolled\s*\{.*?\}/s', '', $css);
$css = preg_replace('/body\.light-mode \.glass-nav\.scrolled\s*\{.*?\}/s', '', $css);

// Remove light mode specific hacks block
$css = preg_replace('/\\/\\* Light Mode Specific Styles \\*\\/.*?\.glass-card\s*\{/s', ".glass-card {", $css);

// Remove light mode background shapes and texts blocks at the end of @media or before animations
$css = preg_replace('/\\/\\* Light Mode Background Shapes \\*\\/.*?\}/s', '', $css);
$css = preg_replace('/\\/\\* Light Mode Text Colors for various elements \\*\\/.*?\}/s', '', $css);
$css = str_replace("body.light-mode .icon-box {\r\n    background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(124, 58, 237, 0.08)) !important;\r\n}\r\n}", '', $css);
$css = str_replace("body.light-mode .icon-box {\n    background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(124, 58, 237, 0.08)) !important;\n}\n}", '', $css);

$glass_card = <<<EOT
.glass-card {
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    box-shadow: var(--glass-shadow);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}
EOT;
$css = preg_replace('/\.glass-card\s*\{.*?\}/s', $glass_card, $css);

$glass_badge = <<<EOT
.glass-badge {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(8px);
    color: var(--text-primary) !important;
}
EOT;
$css = preg_replace('/\.glass-badge\s*\{.*?\}/s', $glass_badge, $css);

$glass_input = <<<EOT
.glass-input {
    background: var(--glass-bg) !important;
    border: 1px solid var(--glass-border) !important;
    color: var(--text-primary) !important;
    backdrop-filter: blur(8px);
}
.glass-input::placeholder {
    color: var(--text-muted) !important;
}
.glass-input:focus {
    background: var(--bg-color) !important;
    border-color: var(--accent-color) !important;
    box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.25) !important;
}
EOT;
$css = preg_replace('/\.glass-input\s*\{.*?\.glass-input:focus\s*\{.*?\}/s', $glass_input, $css);

$overlay = <<<EOT
.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.8), rgba(6, 182, 212, 0.6));
    opacity: 0;
    z-index: 1;
    transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(5px);
    display: flex;
    align-items: center;
    justify-content: center;
}
body.light-mode .project-overlay {
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.6), rgba(6, 182, 212, 0.4));
}
EOT;
$css = preg_replace('/\.project-overlay\s*\{.*?\}/s', $overlay, $css);

file_put_contents('style.css', $css);
echo "Updated style.css\n";
?>
