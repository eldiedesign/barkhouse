<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <?php $alert = get_field('alert_bar', 'options');
  $alertActive = get_field('alert_active', 'options');
  $additionalBodyClasses = [];
  if(is_singular('product')) {
    $terms = get_the_terms($post->ID, 'product_cat');
    if(!empty($terms)) {
      $additionalBodyClasses[] = 'cat_'.$terms[0]->slug;
    }
  }
  if($alert && $alertActive) {
    $additionalBodyClasses[] = 'alert-bar';
  }
  $additionalBodyClasses[] = 'utility-bar'; ?>
  <body <?php body_class($additionalBodyClasses) ?>>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div id="body-wrap">
      <div class="wrap" role="document">
        @include('partials.page-header')
        @include('partials.breadcrumbs')
        @if (App\display_sidebar())
          <div class="content container">
            <main class="main">
              @yield('content')
            </main>
            <aside class="sidebar">
              @include('partials.sidebar')
            </aside>
          </div>
        @else 
          <div class="content">
            <main class="main">
              @yield('content')
            </main>
          </div>
        @endif
      </div>
      <?php if(!is_page_template('views/template-products.blade.php') && !is_single(31680)) { ?>
        @include('partials.cta-banner')
      <?php } ?>
      @include('partials.testimonials')
      <?php if(is_page_template('views/template-product-single-landing.blade.php')) { ?>
        @include('partials.production')
      <?php } ?>
      @include('partials.related')
      @include('partials.testimonial-product')
      <?php if(!is_page_template('views/template-product-single-landing.blade.php')) { ?>
        @include('partials.production')
      <?php } ?>
      @include('partials.cart-help')
      @include('partials.connected')
      @php do_action('get_footer') @endphp
      @include('partials.footer')
    </div> <!-- / #body-wrap -->
    @php wp_footer() @endphp
  </body>
</html>
