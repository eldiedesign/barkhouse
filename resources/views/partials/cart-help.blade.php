<?php if(is_account_page() || is_cart() || is_checkout()) {
  $helpHeading = get_field('help_heading', 'options');
  $helpContent = get_field('help_content', 'options'); ?>

  <section class="cart-help">
    <div class="heading-wrap">
      <div class="container">
        <h2><?= $helpHeading ?></h2>
      </div>
    </div>
    <div class="content-wrap">
      <div class="container">
        <?= $helpContent ?>
      </div>
    </div>
  </section>
<?php }