<?php global $post;
$showBanner = get_field('show_call_to_action_banner', $post->ID);
$ctaBg = get_field('banner_cta_background', $post->ID);
$ctaHeading = get_field('banner_cta_heading', $post->ID);
$ctaLink = get_field('banner_cta_link', $post->ID);
if(is_page_template('views/template-products.blade.php') || is_singular('product')) {
  $showBanner = true;
  if(has_term('Samples', 'product_cat')) {
    $showBanner = false;
  }
  $ctaBg = get_field('shop_banner_cta_background', 'options');
  $ctaHeading = get_field('shop_banner_cta_heading', 'options');
  $ctaLink = get_field('shop_banner_cta_link', 'options');
}
if($showBanner && $ctaBg && ($ctaLink || $ctaHeading)) { ?>
  <section class="cta-banner">
    <?php /* <div class="the-image" data-parallax="scroll" data-image-src="<?= $ctaBg['sizes']['full_width'] ?>"></div> */ ?>
    <div class="the-image" style="background:url(<?= $ctaBg['sizes']['full_width'] ?>) no-repeat;"></div>
    <div class="container">
      <?php echo $ctaHeading ? "<h2>$ctaHeading</h2>" : '';
      echo "<a href='{$ctaLink['url']}'>{$ctaLink['title']}</a>"; ?>
    </div>
  </section>
<?php }