<?php $bannerHeading = get_field('banner_heading');
$bannerLink = get_field('banner_link_button');
$slider = get_field('home_slider');
$n = 0; ?>

<section class="page-header has-featured-image home-slider-wrap">
  <div class="container">
    <div class="banner-cta">
      <?php echo $bannerHeading ? "<h2>".strip_tags($bannerHeading, ['b', 'strong', 'br'])."</h2>" : ''; 
      echo $bannerLink ? "<a href='{$bannerLink['url']}'>{$bannerLink['title']}</a>" : ''; ?>
    </div>
  </div>
  <div id="home-slider">
    <?php foreach($slider as $img) {
      $n++;
      $open = $n == 1 ? 'open' : '';
      echo $n < 3 ? "<div class='slide slide-$n $open loaded' data-slide='$n'><div class='the-image' style='background:url(".wp_get_attachment_image_url($img['id'], 'large').") no-repeat;'></div></div>" 
      : "<div class='slide slide-$n' data-slide='$n'><div class='the-image' data-image='".wp_get_attachment_image_url($img['id'], 'large')."'></div></div>";
    }
    if(count($slider) > 1) {
      echo '<button class="slider-prev hidden">previous slide</button>';
      echo '<button class="slider-next">next slide</button>';
    } ?>
  </div>
</section>
