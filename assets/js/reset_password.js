document.addEventListener('DOMContentLoaded', function() {
    const resetForm = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    // Password validation
    passwordInput.addEventListener('input', function() {
        const password = this.value.trim();

        if (!password) {
            this.classList.remove('is-invalid');
            passwordError.textContent = '';
        } else if (password.length < 6) {
            this.classList.add('is-invalid');
            passwordError.textContent = 'Password must be at least 6 characters';
        } else {
            this.classList.remove('is-invalid');
            passwordError.textContent = '';
        }

        // Check password confirmation match
        if (confirmPasswordInput.value.trim()) {
            if (confirmPasswordInput.value.trim() !== password) {
                confirmPasswordInput.classList.add('is-invalid');
                confirmPasswordError.textContent = 'Passwords do not match';
            } else {
                confirmPasswordInput.classList.remove('is-invalid');
                confirmPasswordError.textContent = '';
            }
        }
    });

    // Confirm password validation
    confirmPasswordInput.addEventListener('input', function() {
        const confirmPassword = this.value.trim();
        const password = passwordInput.value.trim();

        if (!confirmPassword) {
            this.classList.remove('is-invalid');
            confirmPasswordError.textContent = '';
        } else if (confirmPassword !== password) {
            this.classList.add('is-invalid');
            confirmPasswordError.textContent = 'Passwords do not match';
        } else {
            this.classList.remove('is-invalid');
            confirmPasswordError.textContent = '';
        }
    });

    // Form submission
    resetForm.addEventListener('submit', function(e) {
        let isValid = true;

        // Validate password
        const password = passwordInput.value.trim();
        if (!password) {
            passwordInput.classList.add('is-invalid');
            passwordError.textContent = 'Password is required';
            isValid = false;
        } else if (password.length < 6) {
            passwordInput.classList.add('is-invalid');
            passwordError.textContent = 'Password must be at least 6 characters';
            isValid = false;
        }

        // Validate confirm password
        const confirmPassword = confirmPasswordInput.value.trim();
        if (!confirmPassword) {
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordError.textContent = 'Please confirm your password';
            isValid = false;
        } else if (confirmPassword !== password) {
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordError.textContent = 'Passwords do not match';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
