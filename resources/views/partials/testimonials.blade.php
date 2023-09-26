<?php $tests = get_field('testimonials', 'options');
$showTests = get_field('show_testimonials', $post->ID);
if($tests && $showTests && !is_product() && !is_account_page() && !is_cart() && !is_checkout()) { ?>
  <section class="testimonials">
    <div class="container">
      <div class="test-slider">
        <?php foreach($tests as $test) {
          echo "<div class='slide'>
            <blockquote>
              {$test['quote']}
              <cite>{$test['cite']}</cite>
            </blockquote>
          </div>";
        } ?>
      </div>
    </div>
  </section>
<?php }