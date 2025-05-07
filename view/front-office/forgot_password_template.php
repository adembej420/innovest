<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Forgot Password</h3></div>
                    <div class="card-body">
                        <?php if (isset($error_message) && !empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>

                        <?php if (isset($success_message) && !empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>

                        <p class="text-center mb-4">Enter your email address and we'll send you a link to reset your password.</p>

                        <form action="index.php?page=forgot_password" method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" required />
                                <label for="email">Email address</label>
                                <div id="emailError" class="invalid-feedback"></div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="index.php?page=login">Return to Login</a>
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="index.php?page=register">Need an account? Sign up!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


