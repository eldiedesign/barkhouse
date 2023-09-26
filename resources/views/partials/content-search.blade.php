<?php $pId = get_the_id();
if(!empty(get_the_post_thumbnail_url($pId))) {
  $thumb = get_the_post_thumbnail_url($pId, 'medium');
} else {
  $thumb = get_field('search_default_image', 'options') ? get_field('search_default_image', 'options')['sizes']['medium'] : '';
} ?>

<div class="container">
  <article <?php post_class(); ?>>
    <?php /* <div class="col-3">
      <a href="<?php the_permalink(); ?>"><div class="the-thumb" style="background:url(<?= $thumb ?>) no-repeat;"></div></a>
    </div> */ ?>
    <div>
      <header>
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php if(is_plugin_active('relevanssi/relevanssi.php')) { relevanssi_the_title(); } else { the_title(); } ?></a> </h3>
      </header>
      <div class="entry-summary">
        <p><?php echo get_the_excerpt(); ?></p>
        <a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
      </div>
    </div>
  </article>
</div>