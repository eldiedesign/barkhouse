<?php $test = get_field('product_testimonial', $post->ID);
$cite = get_field('product_testimonial_cite', $post->ID);
if($test) { ?>
  <section class="testimonials">
    <div class="container">
      <div class="product-testimonial">
        <?php echo "<blockquote>
          $test
          <cite>$cite</cite>
        </blockquote>"; ?>
      </div>
    </div>
  </section>
<?php }