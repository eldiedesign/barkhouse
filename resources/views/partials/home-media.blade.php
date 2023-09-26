<?php $mediaHeading = get_field('media_heading');
$mediaFeats = get_field('media_features');
//$mediaBtnText = get_field('button_text');
//$mediaBtnUrl= get_field('button_link'); ?>

<section class="home-media">
  <div class="container">
    <?php echo $mediaHeading ? "<h2>$mediaHeading</h2>" : '';
    if($mediaFeats) {
      echo '<div class="media-features">';
      foreach($mediaFeats as $mf) {
        $fId = $mf['feature'];
        $fTitle = get_the_title($fId);
        $fLink = get_the_permalink($fId);
        $fImg = has_post_thumbnail($fId) ? get_the_post_thumbnail_url($fId, 'medium_large') : get_field('related_default_image', 'options')['sizes']['medium_large'];
        echo "<div class='media-feature'>
          <div class='inner'>
            <a href='$fLink' class='img-wrap'>
              <div class='the-image' style='background:url($fImg) no-repeat'></div>
            </a>
            <h4><a href='$fLink'>$fTitle</a></h4>
          </div>
        </div>";
      }
      echo '</div>';
    }
   /*  echo $mediaBtnText && $mediaBtnUrl ? "<a class='feature-cta' href='$mediaBtnUrl'>".strip_tags($mediaBtnText, ['br', 'b', 'strong'])."</a>" : ''; */ ?>
  </div>
</section>