<?php $prodImg = get_field('production_photo', $post->ID);
$prodBlurb = get_field('production_statement', $post->ID);
if($prodImg) { ?>
  <section class="production">
    <?= "<img src='{$prodImg['sizes']['full_width']}' width='{$prodImg['sizes']['full_width-width']}' height='{$prodImg['sizes']['full_width-height']}' alt='{$prodImg['alt']}'/>";
    if($prodBlurb) { ?>
      <div class="production-blurb">
        <div class="container">
          <?= $prodBlurb ?>
        </div>
      </div>
    <?php } ?>
  </section>
<?php }