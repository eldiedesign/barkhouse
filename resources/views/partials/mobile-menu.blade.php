<?php $utilityMobile = get_field('utility_mobile_behavior', 'options');
$utilityLinks = get_field('utility_bar_links', 'options'); ?>
<div id="mobile-menu">
  <div class="brand-wrap">
    <a class="brand-mobile" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
  </div>
  <div style="position:relative">
    <?php if($utilityLinks && $utilityMobile == 'hidden_mobile') { ?>
      <ul id="utility-mobile" class="menu">
        <?php foreach($utilityLinks as $l) {
          $target = $l['link']['target'] == '_blank' ? 'target="_blank"' : '';
          echo "<li><a href='{$l['link']['url']}' $target>{$l['link']['title']}</a></li>";
        } ?>
      </ul>
    <?php }
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu(['theme_location' => 'primary_navigation']);
    endif; 
    if (has_nav_menu('top_navigation')) :
      wp_nav_menu(['theme_location' => 'top_navigation']);
    endif; ?>
  </div>
  <?php // @include('partials.social') ?>
</div>