<?php $alert = get_field('alert_bar', 'options');
$alertActive = get_field('alert_active', 'options');
$utilityLinks = get_field('utility_bar_links', 'options');
$email = get_field('email', 'options');
$phone = get_field('phone', 'options');
$phoneLink = preg_replace('/[^0-9]/', '', $phone);
$cartTotal = WC()->cart->get_cart_contents_count(); ?>

<nav id="utility-bar">
  <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
  <div class="container">
    <div class="col-4 welcome">
      <?php
      echo !is_user_logged_in() ? "Welcome, guest. <a href='/my-account/'>Sign in</a> or <a href='/my-account/'>create an account</a>." : "Welcome, <a href='/my-account/'>" . wp_get_current_user()->data->display_name . '</a>'; ?>

    </div>
    <div class="col-8 utility-nav-wrap">
      <ul>
        <li class="cart cart-header-count"><a href="/cart/">Cart (<span id="the-cart-count"><?php echo $cartTotal; ?></span>)</a></li>
        <li class="login"><a href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php echo is_user_logged_in() ? 'My account' : 'Sign in'; ?></a></li>
        <?php echo $phone ? "<li class='phone'><a href='tel:+1$phoneLink'>$phone</a></li>" : '';
        echo $email ? "<li class='email'><a href='mailto:$email'>$email</a></li>" : ''; ?>
      </ul>
    </div>
    <button id="menu-toggle" class="hamburger hamburger--spin" type="button">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </button>
  </div>
</nav>

<header class="banner">
  <div class="container">
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
      <div class="cart-mobile"><a href="/cart/">Cart<?= $cartTotal == 0 ? '' : " ($cartTotal)"; ?></a></div>
      <div class="search-form-wrap">
        <?php get_search_form(); ?>
      </div>
    </nav>
  </div>
</header>
<?php if ($alert && $alertActive) { ?>
  <section id="alert-bar">
    <div class="container">
      <?php echo $alert ?>
    </div>
  </section>
<?php } ?>