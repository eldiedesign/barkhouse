<?php 
$prodImg = get_field('production_photo');
$prodBlurb = get_field('production_cta');
if($prodImg) { ?>
  <section class="home-production" data-parallax="scroll" data-image-src="<?= $prodImg['sizes']['full_width'] ?>">
    <div id="us-made"><h3 class="sr-only">100% Sourced and Made in the USA</h3></div>
    <?php echo $prodBlurb ? "<div class='blurb'>$prodBlurb</div>" : ''; ?>
  </section>
<?php }