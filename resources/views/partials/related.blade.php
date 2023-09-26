<?php $showRelated = get_field('show_related_content', $post->ID);
$related = get_field('related_content', $post->ID);
if($showRelated && $related) {
  $rHeading = get_field('related_heading', $post->ID); ?>
  <section class="related-content">
    <?php echo $rHeading ? "<div class='related-heading'>$rHeading</div>" : ''; ?>
    <div class="container">
      <?php foreach($related as $rel) {
        $rId = $rel['related_post'];
        $thumb = $rel['thumbnail'];
        $rTitle = get_the_title($rId);
        $rLink = get_the_permalink($rId);
        $rImg = has_post_thumbnail($rId) ? get_the_post_thumbnail_url($rId, 'medium_large') : get_field('related_default_image', 'options')['sizes']['medium'];
        $thumb = !empty($thumb) ? $thumb['sizes']['medium_large'] : $rImg;
        echo "<div class='related'>
          <div class='inner'>
            <a href='$rLink' class='img-wrap'>
              <div class='the-image' style='background:url($thumb) no-repeat'></div>
            </a>
            <h3><a href='$rLink'>$rTitle</a></h3>
          </div>
        </div>";
      } ?>
    </div>
  </section>
<?php }