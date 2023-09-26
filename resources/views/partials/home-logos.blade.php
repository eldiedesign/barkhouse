<?php $logosHeading = get_field('logos_heading');
$logos = get_field('logos_image');
if($logos) { ?>
  <section class="home-logos">
    <div class="container">
      <?php echo $logosHeading ? "<h2>".strip_tags($logosHeading, ['b', 'strong', 'br'])."</h2>" : ''; ?>
    </div>
    <?= "<img class='the-logos' loading='lazy' src='{$logos['sizes']['full_width']}' width='{$logos['sizes']['full_width-width']}' height='{$logos['sizes']['full_width-height']}' alt='{$logos['alt']}'/>"; ?>
  </section>
<?php }
 /* $logosHeading = get_field('logos_heading');
$logos = get_field('logos');
$numSlides = count($logos);
$slideWidth = (100 / $numSlides).'%';
$ulWidth = (14.2 * $numSlides).'%';
if($logos) { ?>
  <section class="home-logos">
    <div class="container">
      <?php echo $logosHeading ? "<h2>".strip_tags($logosHeading, ['b', 'strong', 'br'])."</h2>" : ''; ?>
    </div>
    <div class="logos-slider-wrap" data-slidecount="<?= $numSlides ?>">
      <button class="logo-slide-prev"><span class="sr-only">Previous Slide</span></button>
        <ul class="logos-slider" style="width:<?= $ulWidth ?>">
          <?php foreach($logos as $l) {
            echo "<li class='logo-slide' style='width:$slideWidth'>
              <h3 class='sr-only'>{$l['logo_title']}</h3>
              <div class='the-image' style='background:url({$l['logo_image']['sizes']['medium']}) no-repeat'></div>
            </li>";
          } ?>
        </ul>
      <button class="logo-slide-next"><span class="sr-only">Next Slide</span></button>
    </div>
  </section>
<?php } */