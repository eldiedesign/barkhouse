<?php global $post;
if(is_404()) { ?>
  <section class="page-header no-featured-image">
    <div class="container"></div>
  </section>
<?php } elseif((has_post_thumbnail($post->ID) || get_field('banner_image', $post->ID)) && !is_category() && !is_singular('post') && !is_home() && !is_search() && !is_singular('product') && !is_page_template('views/template-product-gallery.blade.php')) { ?>
  <section class="page-header has-featured-image">
    <?php $terms = get_the_terms($post->ID, 'product_cat');
    $cat = !empty($terms) ? $terms[0]->term_taxonomy_id : null;
    $featImg = (is_singular('product') || is_page_template('views/template-product-single-landing.blade.php')) && get_field('banner_image', $post->ID) ? get_field('banner_image', $post->ID)['sizes']['full_width'] : get_the_post_thumbnail_url($post->ID, 'full_width'); ?>
    <div class="banner-image" data-parallax="scroll" data-image-src="<?= $featImg ?>"></div>
  </section>
<?php } else { ?>
  <section class="page-header no-featured-image">
    <div class="container"></div>
  </section>
<?php }

// 395afeef37c77eb4bb89a33effbc85cc70064bfa.php