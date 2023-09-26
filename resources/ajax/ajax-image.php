<?php require_once(__DIR__ . '/../../../../../wp-includes/wp-db.php');
require(__DIR__ . '/../../../../../wp-load.php');
define('WP_USE_THEMES', false);

$formData = file_get_contents('php://input');
$formData = json_decode($formData);

$slides = $formData->slides;
$size = $formData->size;
$slides = explode(', ', $slides);
$images = [];

if(!empty($slides)) {
  foreach($slides as $s) {
    $images[] = wp_get_attachment_image_url($s, $size);
  }
}

echo json_encode($images);

return;