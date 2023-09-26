<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <?php $alert = get_field('alert_bar', 'options');
  $alertActive = get_field('alert_active', 'options');
  $additionalBodyClasses = [];
  if($alert && $alertActive) {
    $additionalBodyClasses[] = 'alert-bar';
  }
  $additionalBodyClasses[] = 'utility-bar'; ?>
  <body <?php body_class($additionalBodyClasses) ?>>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div id="body-wrap">
      <div class="wrap" role="document">
        <div class="content">
          <main class="main">
            @yield('content')
          </main>
        </div>
      </div>
      @include('partials.connected')
      @php do_action('get_footer') @endphp
      @include('partials.footer')
    </div> <!-- / #body-wrap -->
    @php wp_footer() @endphp
  </body>
</html>
