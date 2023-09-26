<?php $accordions = get_field('teaser_accordions');
$gallery = get_field('teaser_gallery');
$cta = get_field('teaser_cta'); ?>
<section class="home-accordion">
  <div class="container">
    <div class="col-12">
      <div class="col-6 teaser-wrap">
        <?php if($gallery) {
          $n = 0;
          echo '<div class="teaser-gallery" aria-hidden="true">';
          foreach($gallery as $g) {
            $n++;
            echo "<div class='the-image image-$n' style='background:url({$g['sizes']['medium_large']}) no-repeat'></div>";
          }
          echo '</div>';
        } ?>
      </div>
      <div class="col-6 teaser-accordions">
        <?php if($accordions) {
          foreach($accordions as $a) {
            echo "<div class='ihmm-accordion-wrap'>
              <h3 class='ihmm-accordion-toggle'>{$a['heading']}</h3>
              <div class='ihmm-accordion-content'>
                <div class='inner'>
                  {$a['content']}
                </div>
              </div>
            </div>";
          }
        } ?>
      </div>
    </div>
    <div class="cta-wrap col-12">
      <?php echo $cta ? "<a href='{$cta['url']}'>{$cta['title']}</a>" : ''; ?>
    </div>
  </div>
</section>