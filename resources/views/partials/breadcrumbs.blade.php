<?php if(is_home() || is_category()) {
  $theTitle = get_the_title( get_option('page_for_posts', true) );
} elseif(is_search()) {
  $theTitle = isset($_GET['s']) ? 'Search results for: “'.$_GET['s'].'”' : 'Search results';
} elseif(is_404()) {
  $theTitle = 'Page not found';
} elseif(get_post_parent() != null && get_post_parent($post->ID)->ID == '31408') {
  $theTitle = 'Media Coverage: '.get_the_title($post->ID);
} else {
  $theTitle = get_the_title($post->ID);
} ?>
<section class="breadcrumbs">
  <div class="container">
    <div class="col-6 title-wrap">
      <?php if(is_singular('post') || is_category()) { ?>
        <h2>EmBark<sup>TM</sup> Blog</h2>
      <?php } else { ?>
        <h1><?= $theTitle ?></h1>
      <?php } ?>
    </div>
    <div class="col-6 breadcrumb-wrap">
      <a href="/">Home</a> <span class="delineator">&gt;</span> 
      <?php if(is_page_template('views/template-sample-kits.blade.php')) {
        echo "<a href='/natural-bark-wood-products/'>Products</a> <span class='delineator'>&gt;</span> ";
      }
      if(is_singular('post')) {
        echo "<a href='embark-blog'>EmBark Blog</a> <span class='delineator'>&gt;</span> ";
        $cat = get_the_category($post->ID);
        echo $cat ? "<a href='/category/{$cat[0]->slug}/'>{$cat[0]->name}</a> <span class='delineator'>&gt;</span> " : '';
      }
      echo is_page('poplar-bark-panel-catalog') ? "<a href='/natural-bark-wood-products/'>Products</a> <span class='delineator'>&gt;</span> <a href='/natural-bark-wood-products/poplar-bark-panel-wall-coverings/'>Poplar Bark Panel Wall Coverings</a> <span class='delineator'>&gt;</span> " : '';
      echo is_page('live-edge-slab-catalog') ? "<a href='/natural-bark-wood-products/'>Products</a> <span class='delineator'>&gt;</span> <a href='/natural-bark-wood-products/live-edge-slabs/'>Live Edge Slabs</a> <span class='delineator'>&gt;</span> " : '';
      if(is_singular('product')) {
        echo "<a href='/natural-bark-wood-products/'>Products</a> <span class='delineator'>&gt;</span> ";
        $terms = get_the_terms($post->ID, 'product_cat');
        $cat = $terms[0]->slug;
        echo $cat == 'panels' ? "<a href='/poplar-bark-panel-catalog/'>Poplar Bark Panel Catalog</a> <span class='delineator'>&gt;</span> " : '';
        echo $cat == 'live-edge-slabs' ? "<a href='/live-edge-slab-catalog/'>Live Edge Slab Catalog</a> <span class='delineator'>&gt;</span> " : '';
        echo $cat == 'sample-kits' ? "<a href='/sample-kits/'>Sample Kits</a> <span class='delineator'>&gt;</span> " : '';
        if($cat == 'live-edge-slabs') {
          $theTitle = _get_string_between($theTitle, '[', ']') != '' ? _get_string_between($theTitle, '[', ']') : $theTitle;
        }
      }
      $parent = get_post_parent($post->ID);
      $parentTitle = $parent->ID == 24862 ? 'Products' : $parent->post_title;
      if($parent) {
        $grandparent = get_post_parent($parent->ID);
        if($grandparent) {
          $grandparentTitle = $grandparent->ID == 24862 ? 'Products' : $grandparent->post_title;
          echo "<a href='{$grandparent->guid}'>$grandparentTitle</a> <span class='delineator'>&gt;</span> ";
        }
        echo "<a href='/?p={$parent->ID}'>$parentTitle</a> <span class='delineator'>&gt;</span> ";
        echo "<span class='breadcrumb_last' aria-current='page'>{$post->post_title}</span>";
      } else {
        echo "<span class='breadcrumb_last' aria-current='page'>$theTitle</span>";
      } ?>
    </div>
  </div>
</section>