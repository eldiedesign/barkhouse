<section class="connected">
  <?php if(is_front_page()) { ?>
    <div class="container">
      <blockquote>
        <p>It is not so much for its beauty that the forest <br>makes a claim upon men's hearts, as for that subtle something, <br>that quality of air that emanation from old trees, that so wonderfully <br>changes and renews a weary spirit.</p>
        <cite>— Robert Louis Stevenson</cite>
      </blockquote>
      <img src="@asset('images/logo-bark-house.png')" width="230" height="230" alt="Bark House | Establish 1990"/>
    </div>
  <?php }
  if(is_cart() || is_checkout() || is_account_page()) { ?>
    @include('partials.contact-links')
  <?php } ?>
  <div class="connected-wrap">
    <div class="container">
      <?php $mc4wpForm = get_posts(['post_type'=>'mc4wp-form', 'post_status'=>'publish']);
      if(!empty($mc4wpForm) && is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php')) {
        $formId = $mc4wpForm[0]->ID;
        $signupHeading = get_field('signup_heading', 'options');
        $signupSubheading = get_field('signup_subheading', 'options'); ?>
        <?php echo $signupHeading ? "<h2>$signupHeading</h2>" : '';
        echo $signupSubheading ? "<h3>$signupSubheading</h3>" : ''; ?>
        <div class="signup-form">
          <?php echo do_shortcode("[mc4wp_form id='$formId']"); ?>
        </div>
      <?php } ?>
      @include('partials.social')
    </div>
  </div>
  <?php if(!is_cart() && !is_checkout() && !is_account_page()) { ?>
    @include('partials.contact-links')
  <?php } ?>
</section>