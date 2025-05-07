<?php
/**
 * Simple CAPTCHA implementation
 */

/**
 * Generate a random CAPTCHA code
 * 
 * @param int $length Length of the CAPTCHA code
 * @return string The generated CAPTCHA code
 */
function generateCaptchaCode($length = 6) {
    // Characters to use in the CAPTCHA (excluding similar-looking characters)
    $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $captchaCode = '';
    
    // Generate random characters
    for ($i = 0; $i < $length; $i++) {
        $captchaCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store the CAPTCHA code in the session
    $_SESSION['captcha_code'] = $captchaCode;
    
    return $captchaCode;
}

/**
 * Verify if the provided CAPTCHA code matches the one in the session
 * 
 * @param string $userInput The user-provided CAPTCHA code
 * @return bool True if the CAPTCHA is valid, false otherwise
 */
function verifyCaptcha($userInput) {
    if (!isset($_SESSION['captcha_code'])) {
        return false;
    }
    
    // Case-insensitive comparison
    return strtoupper($userInput) === strtoupper($_SESSION['captcha_code']);
}

/**
 * Generate HTML for a CAPTCHA challenge
 * 
 * @return string HTML for the CAPTCHA
 */
function generateCaptchaHtml() {
    $captchaCode = generateCaptchaCode();
    
    // Create a simple HTML representation of the CAPTCHA
    $html = '<div class="captcha-container mb-3">';
    $html .= '<label for="captcha" class="form-label">Security Check</label>';
    $html .= '<div class="captcha-code p-2 mb-2 bg-light border rounded text-center" style="letter-spacing: 5px; font-family: monospace; font-size: 24px; font-weight: bold; color: #333; text-shadow: 1px 1px 1px #ccc;">';
    
    // Add some visual noise to make it harder for bots
    for ($i = 0; $i < strlen($captchaCode); $i++) {
        $rotation = rand(-15, 15);
        $color = sprintf('#%02X%02X%02X', rand(50, 150), rand(50, 150), rand(50, 150));
        $html .= '<span style="display: inline-block; transform: rotate(' . $rotation . 'deg); color: ' . $color . ';">' . $captchaCode[$i] . '</span>';
    }
    
    $html .= '</div>';
    $html .= '<div class="input-group">';
    $html .= '<input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter the code above" required>';
    $html .= '<button type="button" class="btn btn-outline-secondary" onclick="window.location.reload();">';
    $html .= '<i class="bi bi-arrow-clockwise"></i> New Code';
    $html .= '</button>';
    $html .= '</div>';
    $html .= '<div class="form-text">Enter the characters you see above (not case sensitive).</div>';
    $html .= '</div>';
    
    return $html;
}
?>
