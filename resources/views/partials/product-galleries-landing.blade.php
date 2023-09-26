<div class="container entry-content">
  <?php the_content(); ?>
  <div class="gallery-page-grid">
    <?php $galleryPages = get_children(['post_parent' => $post->ID, 'post_type' => 'page', 'fields' => 'ids']);
    if($galleryPages) {
      foreach($galleryPages as $gp) {
        $thumb = has_post_thumbnail($gp) ? get_the_post_thumbnail_url($gp, 'medium_large') : get_field('blog_default_image', 'options')['sizes']['medium_large'];
        $title = get_the_title($gp);
        $link = get_the_permalink($gp);
        echo "<div class='col-4 gallery-page'>
          <a class='img-wrap' href='$link'><div class='the-image' style='background:url($thumb) no-repeat'></div></a>
          <h3><a href='$link'>$title</a></h3>
          <a href='$link'>See more...</a>
        </div>";
      }
    } ?>
  </div>
</div>