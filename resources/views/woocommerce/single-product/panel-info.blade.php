<?php $productId = $post->ID;
$price = get_post_meta( $productId, '_regular_price')[0];
$height = get_post_meta($productId, '_height')[0];
$width = get_post_meta($productId, '_width')[0];
$grade = get_post_meta($productId, 'grade')[0];
$image = get_post_meta( $productId, '_thumbnail_id')[0];
$scaleWidth = intVal($width)*8;
$scaleHeight = intVal($height)*8; ?>

<div class="panel-info">
  <h4><?= $grade ?> Grade Poplar Bark Panel</h4>
  <div class="meta-inner">
    <div class="col-6">
      <strong>Imperial:</strong><br>
      width = <?= $width ?>" (<?= floor($width / 12)?>'<?php if(($width % 12) > 0) { echo ' '.($width % 12).'"'; } ?>)<br>
      height = <?= $height ?>" (<?= floor($height / 12)?>'<?php if(($height % 12) > 0) { echo ' '.($height % 12).'"'; } ?>)<br>
      <?= round(((($width*$height)/12)/12), 2, PHP_ROUND_HALF_UP); ?> sq ft
      <input type="hidden" id="total-sqft" value="<?= round(((($width*$height)/12)/12), 2, PHP_ROUND_HALF_UP); ?>"/>
    </div>
    <div class="col-6">
      <strong>Metric:</strong><br>
      width = <?= round(($width*.0254), 2, PHP_ROUND_HALF_UP); ?>m<br>
      height = <?= round(($height*.0254), 2, PHP_ROUND_HALF_UP); ?>m<br>
      <?= round((((($width*.0254)*($height*.0254)))), 2, PHP_ROUND_HALF_UP); ?> sq m
    </div>
    <span class="sq"></span>
  </div>
</div>