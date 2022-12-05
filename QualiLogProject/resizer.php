<?php
// --- https://code-boxx.com/resize-images-php/ ---
function resizer ($source, $destination, $width, $height, $quality=null) {
// $source - Original image file
// $destination - Resized image file name
// $size - Single number for percentage resize
// Array of 2 numbers for fixed width + height
// $quality - Optional image quality. JPG & WEBP = 0 to 100, PNG = -1 to 9

  $size = array($width, $height);

  // (A) FILE CHECKS
  // (A1) ALLOWED IMAGE FILE EXTENSIONS
  $ext = strtolower(pathinfo($source)["extension"]);
  if (!in_array($ext, ["bmp", "gif", "jpg", "jpeg", "png", "webp"])) {
    throw new Exception("Invalid image file type");
  }

  // (A2) SOURCE IMAGE NOT FOUND!
  if (!file_exists($source)) {
    throw new Exception("Source image file not found");
  }

  // (B) IMAGE DIMENSIONS
  $dimensions = getimagesize($source);
  $width = $dimensions[0];
  $height = $dimensions[1];
  if (is_array($size)) {
    $new_width = $size[0];
    $new_height = $size[1];
  } else {
    $new_width = ceil(($size/100) * $width);
    $new_height = ceil(($size/100) * $height);
  }

  // (C) RESIZE
  // (C1) RESPECTIVE PHP IMAGE FUNCTIONS
  $fnCreate = "imagecreatefrom" . ($ext=="jpg" ? "jpeg" : $ext);
  $fnOutput = "image" . ($ext=="jpg" ? "jpeg" : $ext);

  // (C2) IMAGE OBJECTS
  $original = $fnCreate($source);
  $resized = imagecreatetruecolor($new_width, $new_height);

  // (C3) TRANSPARENT IMAGES ONLY
  if ($ext=="png" || $ext=="gif") {
    imagealphablending($resized, false);
    imagesavealpha($resized, true);
    imagefilledrectangle(
      $resized, 0, 0, $new_width, $new_height,
      imagecolorallocatealpha($resized, 255, 255, 255, 127)
    );
  }

  // (C4) COPY & RESIZE
  imagecopyresampled(
    $resized, $original, 0, 0, 0, 0,
    $new_width, $new_height, $width, $height
  );

  // (D) OUTPUT & CLEAN UP
  if (is_numeric($quality)) {
    $fnOutput($resized, $destination, $quality);
  } else {
    $fnOutput($resized, $destination);
  }
  imagedestroy($original);
  imagedestroy($resized);
}