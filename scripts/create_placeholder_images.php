<?php

// Script to create visible placeholder images for dummy data
$directories = [
    'storage/app/public/logos',
    'storage/app/public/postingan',
    'storage/app/public/agenda',
    'storage/app/public/aspirasi',
    'storage/app/public/proposal',
];

// Create directories if they don't exist
foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
        echo "Created directory: $dir\n";
    }
}

// Function to create a simple colored placeholder image
function createPlaceholderImage($filepath, $width = 400, $height = 300, $color = [100, 150, 200]) {
    // Check if GD is available
    if (!extension_loaded('gd')) {
        // If GD is not available, create a simple text file as placeholder
        file_put_contents($filepath, "PLACEHOLDER IMAGE\nSize: {$width}x{$height}\nReplace with actual image for production.");
        return false;
    }
    
    // Create image
    $image = imagecreatetruecolor($width, $height);
    
    // Allocate colors
    $bgColor = imagecolorallocate($image, $color[0], $color[1], $color[2]);
    $textColor = imagecolorallocate($image, 255, 255, 255);
    
    // Fill background
    imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);
    
    // Add text
    $filename = basename($filepath);
    imagestring($image, 5, 10, 10, "Placeholder:", $textColor);
    imagestring($image, 3, 10, 30, $filename, $textColor);
    imagestring($image, 3, 10, 50, "{$width}x{$height}", $textColor);
    
    // Save image
    imagejpeg($image, $filepath, 85);
    imagedestroy($image);
    
    return true;
}

// Create logo placeholders (different colors for each university)
$logoColors = [
    'logo-universitas-gadjah-mada.png' => [255, 200, 0],      // Yellow
    'logo-universitas-indonesia.png' => [0, 100, 200],        // Blue
    'logo-institut-teknologi-bandung.png' => [200, 0, 0],     // Red
    'logo-universitas-airlangga.png' => [0, 150, 100],        // Green
    'logo-universitas-padjadjaran.png' => [150, 0, 150],      // Purple
    'logo-universitas-diponegoro.png' => [0, 150, 200],       // Cyan
    'logo-universitas-sebelas-maret.png' => [200, 100, 0],    // Orange
    'logo-universitas-brawijaya.png' => [100, 150, 0],        // Olive
];

foreach ($logoColors as $filename => $color) {
    $filepath = 'storage/app/public/logos/' . $filename;
    if (!file_exists($filepath)) {
        createPlaceholderImage($filepath, 200, 200, $color);
        echo "Created logo: $filename\n";
    }
}

// Create generic placeholder images for other directories
$genericFiles = [
    'storage/app/public/postingan/placeholder.jpg',
    'storage/app/public/agenda/placeholder.jpg',
    'storage/app/public/aspirasi/placeholder.pdf',
    'storage/app/public/proposal/placeholder.pdf',
];

foreach ($genericFiles as $filepath) {
    if (!file_exists($filepath)) {
        $ext = pathinfo($filepath, PATHINFO_EXTENSION);
        
        if ($ext === 'jpg' || $ext === 'jpeg') {
            createPlaceholderImage($filepath, 400, 300, [120, 180, 220]);
            echo "Created image: $filepath\n";
        } else {
            // For PDFs, create a text placeholder
            file_put_contents($filepath, "PLACEHOLDER PDF\nReplace with actual PDF file for production.\nFilename: " . basename($filepath));
            echo "Created PDF placeholder: $filepath\n";
        }
    }
}

echo "\n✓ All placeholder images created successfully!\n";
echo "Note: These are colored placeholder images. Replace them with actual images for production use.\n";