document.addEventListener('DOMContentLoaded', function() {
    const forgotForm = document.querySelector('form');
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');

    // Email validation
    emailInput.addEventListener('input', function() {
        const email = this.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email) {
            this.classList.remove('is-invalid');
            emailError.textContent = '';
        } else if (!emailRegex.test(email)) {
            this.classList.add('is-invalid');
            emailError.textContent = 'Please enter a valid email address';
        } else {
            this.classList.remove('is-invalid');
            emailError.textContent = '';
        }
    });

    // Form submission
    forgotForm.addEventListener('submit', function(e) {
        let isValid = true;

        // Validate email
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            emailInput.classList.add('is-invalid');
            emailError.textContent = 'Email is required';
            isValid = false;
        } else if (!emailRegex.test(email)) {
            emailInput.classList.add('is-invalid');
            emailError.textContent = 'Please enter a valid email address';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
