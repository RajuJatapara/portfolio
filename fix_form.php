<?php
$html = file_get_contents('index.html');

$contactStart = strpos($html, '<section id="contact"');
$contactEnd = strpos($html, '</section>', $contactStart) + strlen('</section>');

$newContactSection = <<<HTML
    <section id="contact" class="py-6 section-padding position-relative">
        <div class="bg-shape-5"></div>
        <div class="container position-relative z-1">
            <div class="section-title text-center mb-5 reveal-up">
                <span class="text-accent text-uppercase fw-bold tracking-widest small">Get In Touch</span>
                <h2 class="display-5 fw-bold text-white mt-2">Contact Me</h2>
                <div class="title-line mx-auto mt-3"></div>
            </div>

            <div class="row g-5 justify-content-center mt-4">
                <div class="col-lg-5 reveal-left">
                    <div class="glass-card p-5 rounded-4 h-100">
                        <h3 class="fs-3 fw-bold text-white mb-4">Let's Talk About Your Project</h3>
                        <p class="text-light opacity-75 mb-5">
                            I am always open to discussing new projects, creative ideas or opportunities to be part of your visions.
                        </p>
                        
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div class="contact-icon bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                <i class="fas fa-phone-alt fs-5"></i>
                            </div>
                            <div>
                                <span class="d-block text-light opacity-75 small fw-medium mb-1">Call Me At</span>
                                <a href="tel:+916356239260" class="text-white fw-semibold text-decoration-none fs-5 hover-accent">+91 6356239260</a>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div class="contact-icon bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope fs-5"></i>
                            </div>
                            <div>
                                <span class="d-block text-light opacity-75 small fw-medium mb-1">Email Me</span>
                                <a href="mailto:rajeshjjatapara@gmail.com" class="text-white fw-semibold text-decoration-none fs-5 hover-accent">rajeshjjatapara@gmail.com</a>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-4 mb-5">
                            <div class="contact-icon bg-gradient text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt fs-5"></i>
                            </div>
                            <div>
                                <span class="d-block text-light opacity-75 small fw-medium mb-1">Location</span>
                                <span class="text-white fw-semibold fs-5">Ahmedabad, Gujarat</span>
                            </div>
                        </div>

                        <div class="pt-4 border-top border-secondary border-opacity-50">
                            <span class="d-block text-white fw-medium mb-3">Connect with me:</span>
                            <div class="d-flex gap-3">
                                <a href="#" class="social-link glass-btn rounded-circle d-flex align-items-center justify-content-center text-white text-decoration-none" aria-label="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#" class="social-link glass-btn rounded-circle d-flex align-items-center justify-content-center text-white text-decoration-none" aria-label="GitHub">
                                    <i class="fab fa-github"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7 reveal-right">
                    <form class="glass-card p-5 rounded-4 contact-form h-100 d-flex flex-column justify-content-center needs-validation" novalidate>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control glass-input" id="name" placeholder="Your Name" required>
                                    <label for="name" class="text-light opacity-75">Your Name</label>
                                    <div class="invalid-feedback text-start mt-1">Please enter your name.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control glass-input" id="email" placeholder="Your Email" required>
                                    <label for="email" class="text-light opacity-75">Your Email</label>
                                    <div class="invalid-feedback text-start mt-1">Please enter a valid email.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control glass-input" id="subject" placeholder="Subject" required>
                                    <label for="subject" class="text-light opacity-75">Subject</label>
                                    <div class="invalid-feedback text-start mt-1">Please enter a subject.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control glass-input" id="message" placeholder="Message" style="height: 150px" required></textarea>
                                    <label for="message" class="text-light opacity-75">Message</label>
                                    <div class="invalid-feedback text-start mt-1">Please enter your message.</div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" id="submit-btn" class="btn btn-gradient px-5 py-3 rounded-pill fw-semibold w-100 w-md-auto position-relative overflow-hidden">
                                    <span class="btn-text">Send Message <i class="fas fa-paper-plane ms-2"></i></span>
                                    <span class="loader-spinner d-none"><i class="fas fa-circle-notch fa-spin"></i> Sending...</span>
                                    <span class="success-msg d-none"><i class="fas fa-check-circle"></i> Sent Successfully!</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
HTML;

$html = substr_replace($html, $newContactSection, $contactStart, $contactEnd - $contactStart);
file_put_contents('index.html', $html);

// Now update script.js WhatsApp logic
$js = file_get_contents('script.js');

$newContactLogic = <<<JS
    // Contact Form Validation & WhatsApp API
    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Check HTML5 Validation
            if (!contactForm.checkValidity()) {
                e.stopPropagation();
                contactForm.classList.add('was-validated');
                return;
            }

            // Valid Form - Send to WhatsApp
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            const btn = document.getElementById('submit-btn');
            const text = btn.querySelector('.btn-text');
            const spinner = btn.querySelector('.loader-spinner');
            const success = btn.querySelector('.success-msg');
            
            // Show Loader
            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            
            setTimeout(() => {
                // Show Success
                spinner.classList.add('d-none');
                success.classList.remove('d-none');
                btn.classList.add('bg-success');
                btn.style.background = '#10b981';
                
                // Format WhatsApp Message
                const waText = `*New Inquiry from Portfolio!*%0A%0A*Name:* \${name}%0A*Email:* \${email}%0A*Subject:* \${subject}%0A*Message:* \${message}`;
                const waUrl = `https://wa.me/916356239260?text=\${waText}`;
                
                // Open WhatsApp
                window.open(waUrl, '_blank');

                contactForm.reset();
                contactForm.classList.remove('was-validated');
                
                // Reset Button
                setTimeout(() => {
                    success.classList.add('d-none');
                    text.classList.remove('d-none');
                    btn.classList.remove('bg-success');
                    btn.style.background = '';
                }, 3000);
            }, 800);
        });
    }
JS;

$js = preg_replace('/\/\/ Contact Form Animation.*?\}\);[\s\r\n]*\}/s', $newContactLogic, $js);
file_put_contents('script.js', $js);

echo "Fix applied successfully.\n";
?>
