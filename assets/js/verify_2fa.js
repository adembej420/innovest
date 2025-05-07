document.addEventListener('DOMContentLoaded', function() {
    const verifyForm = document.querySelector('form');
    const codeInput = document.getElementById('verification_code');
    const codeError = document.getElementById('codeError');

    // Code validation
    codeInput.addEventListener('input', function() {
        const code = this.value.trim();
        const codeRegex = /^\d{6}$/;

        if (!code) {
            this.classList.remove('is-invalid');
            codeError.textContent = '';
        } else if (!codeRegex.test(code)) {
            this.classList.add('is-invalid');
            codeError.textContent = 'Please enter a valid 6-digit code';
        } else {
            this.classList.remove('is-invalid');
            codeError.textContent = '';
        }
    });

    // Form submission
    verifyForm.addEventListener('submit', function(e) {
        let isValid = true;

        // Validate code
        const code = codeInput.value.trim();
        const codeRegex = /^\d{6}$/;
        if (!code) {
            codeInput.classList.add('is-invalid');
            codeError.textContent = 'Verification code is required';
            isValid = false;
        } else if (!codeRegex.test(code)) {
            codeInput.classList.add('is-invalid');
            codeError.textContent = 'Please enter a valid 6-digit code';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
