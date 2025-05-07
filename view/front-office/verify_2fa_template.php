<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Two-Factor Authentication</h3></div>
                    <div class="card-body">
                        <?php if (isset($error_message) && !empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        
                        <?php if (isset($success_message) && !empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        
                        <p class="text-center mb-4">Please enter the verification code sent to your email.</p>
                        
                        <form action="index.php?page=verify_2fa" method="POST">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="verification_code" name="verification_code" type="text" 
                                       placeholder="000000" required pattern="[0-9]{6}" maxlength="6" />
                                <label for="verification_code">Verification Code</label>
                                <div id="codeError" class="invalid-feedback"></div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="index.php?page=resend_code">Resend Code</a>
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="index.php?page=login">Back to Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
