<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                <div class="card-body">
                    <?php if (isset($error_message) && !empty($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <form action="index.php?page=login" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required />
                            <label for="email">Email address</label>
                            <div id="emailError" class="invalid-feedback"></div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                            <label for="password">Password</label>
                            <div id="passwordError" class="invalid-feedback"></div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" id="remember" name="remember" type="checkbox" />
                            <label class="form-check-label" for="remember">Remember Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <a class="small" href="index.php?page=forgot_password">Forgot Password?</a>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="index.php?page=register">Need an account? Sign up!</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

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
    });

    // Form submission
    loginForm.addEventListener('submit', function(e) {
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

        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
