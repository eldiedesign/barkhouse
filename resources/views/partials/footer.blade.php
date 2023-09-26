<?php $footerBlurb = get_field('footer_blurb', 'options');
$footerMenus = get_field('footer_menus', 'options');

?>
<footer class="content-info">
  <div class="navigation-wrap">
    <div class="container">
      <?php if($footerMenus) {
        foreach($footerMenus as $menu) {
          $items = $menu['menu_items'];
          echo "<div class='col-3'>
            <h4>{$menu['menu_title']}</h4>
            <ul>";
              foreach($items as $menuItem) {
                echo "<li><a href='{$menuItem['menu_item']['url']}'>{$menuItem['menu_item']['title']}</a></li>";
              }
            echo '</ul>
          </div>';
        }
      } ?>
    </div>
  </div>
  <div class="copyright">
    <div class="container">
      Copyright 2021 Bark House<sup">®</sup>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/privacy-policy/">Privacy Policy</a>
      <img src="@asset('images/icons-payment.png')" width="230" height="29" alt="Payment types accepted on this website: Masercard, AMEX, VISA, Discover, PayPal" />
    </div>
  </div>
</footer>