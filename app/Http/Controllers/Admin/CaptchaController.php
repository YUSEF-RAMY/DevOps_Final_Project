<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CaptchaController extends Controller
{
    /**
     * Generate and display CAPTCHA image
     */
    public function generate()
    {
        // Always generate a new CAPTCHA when image is requested
        // This ensures the session value matches what's displayed
        $characters = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ'; // Exclude confusing characters like I, O
        $captchaText = '';
        for ($i = 0; $i < 5; $i++) {
            $captchaText .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        // Store in session as lowercase for case-insensitive comparison
        // Save session immediately
        Session::put('admin_captcha', strtolower($captchaText));
        Session::save(); // Force save to ensure it's persisted
        
        // Create image
        $width = 150;
        $height = 50;
        $image = imagecreatetruecolor($width, $height);
        
        // Colors
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 50, 50, 50);
        $lineColor = imagecolorallocate($image, 200, 200, 200);
        $noiseColor = imagecolorallocate($image, 180, 180, 180);
        
        // Fill background
        imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
        
        // Add noise lines
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
        }
        
        // Add noise dots
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
        }
        
        // Add text with random positioning and rotation
        $fontSize = 5;
        $x = 20;
        $y = 30;
        
        // Display text (already uppercase)
        $displayText = $captchaText;
        
        for ($i = 0; $i < strlen($displayText); $i++) {
            $char = $displayText[$i];
            $angle = rand(-15, 15);
            $xOffset = $i * 25 + rand(-5, 5);
            $yOffset = rand(-5, 5);
            
            // Use built-in font with different colors for each character
            $charColor = imagecolorallocate($image, rand(30, 100), rand(30, 100), rand(30, 100));
            imagestring($image, $fontSize, $x + $xOffset, $y + $yOffset, $char, $charColor);
        }
        
        // Output image
        header('Content-Type: image/png');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        
        imagepng($image);
        imagedestroy($image);
        
        exit;
    }
    
    /**
     * Validate CAPTCHA
     */
    public static function verify($input)
    {
        $sessionValue = Session::get('admin_captcha');
        
        if (empty($sessionValue) || empty($input)) {
            Session::forget('admin_captcha');
            return false;
        }
        
        $inputNormalized = strtolower(trim($input));
        $sessionNormalized = strtolower($sessionValue);
        $isValid = $inputNormalized === $sessionNormalized;
        
        // One-time use - clear after validation
        Session::forget('admin_captcha');
        
        return $isValid;
    }
}

