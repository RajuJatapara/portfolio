<?php
$css = <<<CSS

/* Fix form floating label background and autofill on glass inputs */
.form-floating > .form-control.glass-input:focus ~ label,
.form-floating > .form-control.glass-input:not(:placeholder-shown) ~ label {
    color: var(--primary-color) !important;
}

.form-floating > .form-control.glass-input:focus ~ label::after,
.form-floating > .form-control.glass-input:not(:placeholder-shown) ~ label::after,
.form-floating > textarea.glass-input:focus ~ label::after,
.form-floating > textarea.glass-input:not(:placeholder-shown) ~ label::after {
    background-color: transparent !important;
}

input.glass-input:-webkit-autofill,
input.glass-input:-webkit-autofill:hover, 
input.glass-input:-webkit-autofill:focus, 
textarea.glass-input:-webkit-autofill,
textarea.glass-input:-webkit-autofill:hover,
textarea.glass-input:-webkit-autofill:focus {
    -webkit-text-fill-color: var(--text-primary) !important;
    -webkit-box-shadow: 0 0 0px 1000px rgba(15, 23, 42, 0.9) inset !important;
    transition: background-color 5000s ease-in-out 0s;
}

CSS;
file_put_contents('style.css', $css, FILE_APPEND);
echo "CSS Appended successfully.";
?>
