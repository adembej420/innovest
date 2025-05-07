<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = "Email Verification";
$additionalCss = [
    'css/verify.css'
];

$content = '
<div class="verify-container">
    <div class="verify-box">
        <h2>Email Verification</h2>
        <p class="message">Please enter the verification code sent to your email.</p>
        
        ' . (isset($_SESSION['error_message']) ? '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>' : '') . '
        ' . (isset($_SESSION['success_message']) ? '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>' : '') . '
        
        <form action="index.php?page=verify" method="POST" class="verify-form">
            <div class="form-group">
                <label for="verification_code">Verification Code</label>
                <input type="text" 
                       id="verification_code" 
                       name="verification_code" 
                       class="form-control" 
                       required 
                       pattern="[0-9]{6}" 
                       maxlength="6" 
                       placeholder="Enter 6-digit code">
                <div class="invalid-feedback">
                    Please enter the 6-digit verification code.
                </div>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Verify</button>
                <a href="index.php?page=resend_code" class="btn btn-link">Resend Code</a>
                <a href="index.php?page=login" class="btn btn-link">Back to Login</a>
            </div>
        </form>
    </div>
</div>

<script>
// Form validation
(function () {
    "use strict";
    var forms = document.querySelectorAll(".verify-form");
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener("submit", function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        }, false);
    });
})();

// Auto-format verification code input
document.getElementById("verification_code").addEventListener("input", function(e) {
    this.value = this.value.replace(/[^0-9]/g, "").slice(0, 6);
});
</script>';

include 'layout.php';
