<?php
/**
 * Image-based CAPTCHA implementation
 */

/**
 * Generate a random CAPTCHA code
 * 
 * @param int $length Length of the CAPTCHA code
 * @return string The generated CAPTCHA code
 */
function generateImageCaptchaCode($length = 4) {
    // Characters to use in the CAPTCHA (excluding similar-looking characters)
    $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $captchaCode = '';
    
    // Generate random characters
    for ($i = 0; $i < $length; $i++) {
        $captchaCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store the CAPTCHA code in the session
    $_SESSION['image_captcha_code'] = $captchaCode;
    
    return $captchaCode;
}

/**
 * Verify if the provided CAPTCHA code matches the one in the session
 * 
 * @param string $userInput The user-provided CAPTCHA code
 * @return bool True if the CAPTCHA is valid, false otherwise
 */
function verifyImageCaptcha($userInput) {
    if (!isset($_SESSION['image_captcha_code'])) {
        return false;
    }
    
    // Case-insensitive comparison
    return strtoupper($userInput) === strtoupper($_SESSION['image_captcha_code']);
}

/**
 * Generate HTML for an image-based CAPTCHA challenge
 * 
 * @return string HTML for the CAPTCHA
 */
function generateImageCaptchaHtml() {
    $captchaCode = generateImageCaptchaCode();
    $timestamp = time(); // Add timestamp to prevent caching
    
    $html = '<div class="captcha-container mb-3">';
    $html .= '<label for="captcha" class="form-label">Security Check</label>';
    $html .= '<div class="d-flex align-items-center mb-2">';
    
    // Image CAPTCHA
    $html .= '<div class="captcha-image me-2">';
    $html .= '<img src="index.php?page=generate_captcha&t=' . $timestamp . '" alt="CAPTCHA Image" class="img-fluid border rounded" style="height: 50px;">';
    $html .= '</div>';
    
    // Refresh button
    $html .= '<button type="button" class="btn btn-outline-secondary btn-sm refresh-captcha" onclick="refreshCaptcha()">';
    $html .= '<i class="bi bi-arrow-clockwise"></i> New Image';
    $html .= '</button>';
    $html .= '</div>';
    
    // Input field
    $html .= '<div class="input-group">';
    $html .= '<input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter the code shown in the image" required>';
    $html .= '</div>';
    $html .= '<div class="form-text">Enter the characters you see in the image (not case sensitive).</div>';
    $html .= '</div>';
    
    // Add JavaScript to refresh CAPTCHA
    $html .= '<script>
    function refreshCaptcha() {
        const captchaImg = document.querySelector(".captcha-image img");
        if (captchaImg) {
            captchaImg.src = "index.php?page=generate_captcha&t=" + new Date().getTime();
        }
    }
    </script>';
    
    return $html;
}

/**
 * Generate a CAPTCHA image
 */
function generateCaptchaImage() {
    // Check if CAPTCHA code exists in session, if not generate one
    if (!isset($_SESSION['image_captcha_code'])) {
        generateImageCaptchaCode();
    }
    
    $captchaCode = $_SESSION['image_captcha_code'];
    $width = 150;
    $height = 50;
    
    // Create the image
    $image = imagecreatetruecolor($width, $height);
    
    // Colors
    $background = imagecolorallocate($image, 255, 255, 255); // White background
    $textColors = [
        imagecolorallocate($image, 0, 0, 0),       // Black
        imagecolorallocate($image, 0, 0, 128),     // Navy
        imagecolorallocate($image, 0, 128, 0),     // Green
        imagecolorallocate($image, 128, 0, 0),     // Maroon
        imagecolorallocate($image, 75, 0, 130),    // Indigo
        imagecolorallocate($image, 0, 128, 128),   // Teal
    ];
    
    // Fill the background
    imagefilledrectangle($image, 0, 0, $width, $height, $background);
    
    // Add noise (random dots)
    for ($i = 0; $i < 100; $i++) {
        $noiseColor = imagecolorallocate($image, rand(180, 250), rand(180, 250), rand(180, 250));
        imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
    }
    
    // Add random lines
    for ($i = 0; $i < 5; $i++) {
        $lineColor = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
        imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
    }
    
    // Add the text
    $font = 5; // Built-in font
    $x = 10;
    
    for ($i = 0; $i < strlen($captchaCode); $i++) {
        $textColor = $textColors[rand(0, count($textColors) - 1)];
        $angle = rand(-15, 15);
        $y = rand(20, 30);
        
        // Use imagechar for simplicity (works without GD FreeType support)
        imagechar($image, $font, $x + ($i * 30), $y, $captchaCode[$i], $textColor);
    }
    
    // Output the image
    header('Content-Type: image/png');
    imagepng($image);
    imagedestroy($image);
    exit;
}
?>
