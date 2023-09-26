<?php $productCat = get_field('product_category');
$productCatId = $productCat == 'panels' ? 263 : 270;

$items = get_posts([
  'post_type' => 'product',
  'posts_per_page' => -1,
  'tax_query' => [
    'relation' => 'AND',
    array(
      'taxonomy' => 'product_cat',
      'terms' => array($productCatId),
    ),
  ]
]); ?>

<section class="products-wrap">
  <?php $panHeight = $_POST['pan_height'];
  $panWidth = $_POST['pan_width'];
  $panGrade = $_POST['pan_grade'];
  $panel_sort = $_POST['panel_sort'];
  $sortKey = '_height'; 
  $sortDir = 'DESC';
  $panView = $_POST['pan_view']; ?>

  <form method="post" class="sorting-form">
    <h3 class="bh-catalog-filter-heading"><div class="container">Sorting</div></h3>
    <div class="catalog-filters sorta">
      <div class="container">
        <label><input class="les-cats les-sort" name="slab_sort" checked="" type="radio" value="srld">Length, Descending</label>
        <label><input class="les-cats les-sort" name="slab_sort" type="radio" value="srla">Length, Ascending</label>
        <label><input class="les-cats les-sort" name="slab_sort" type="radio" value="srwd">Width, Descending</label>
        <label><input class="les-cats les-sort" name="slab_sort" type="radio" value="srwa">Width, Ascending</label>
        <input type="submit" name="submit" value="sort">
        <div class="views">
          <label id="grid-view" title="Grid View" class="active" <?php /* if(isset($panView) && $panView == 'grid') { echo 'class="active"'; } */ ?>><input type="radio" value="grid" name="pan_view" checked <?php if(isset($panView) && $panView == 'grid') { echo 'checked'; } ?>/></label>
          <label id="list-view" title="List View" <?php if(isset($panView) && $panView == 'list') { echo 'class="active"'; } ?>><input type="radio" value="list" name="pan_view" <?php if(isset($panView) && $panView == 'list') { echo 'checked'; } ?>/></label>
        </div>
      </div>
    </div>
    <h3 class="bh-catalog-filter-heading"><div class="container">Category</div></h3>
    <div class="catalog-filters">
      <div class="container">
        <label><input class="les-cats les-check" type="checkbox" name="les_cat[]" value="mantle" id="cat-mantle" checked="">Mantels</label>
        <label><input class="les-cats les-check" type="checkbox" name="les_cat[]" value="rect" id="cat-rectangular" checked="">Slabs Rectangular</label>
        <label><input class="les-cats les-check" type="checkbox" name="les_cat[]" value="irregular" id="cat-irregular" checked="">Slabs Irregular</label>
        <label><input class="les-cats les-check" type="checkbox" name="les_cat[]" value="round" id="cat-round" checked="">Slabs Round</label>
      </div>
    </div>
    <h3 class="bh-catalog-filter-heading"><div class="container">Length</div></h3>
    <div class="catalog-filters">
      <div class="container">
        <label><input type="checkbox" id="u72" name="les_size[]" value="u72" class="les-size les-check" checked="">Under 72"</label>
        <label><input type="checkbox" id="u95" name="les_size[]" value="u95" class="les-size les-check" checked="">72" - 95"</label>
        <label><input type="checkbox" id="u119" name="les_size[]" value="u119" class="les-size les-check" checked="">96" - 119"</label>
        <label><input type="checkbox" id="o120" name="les_size[]" value="o120" class="les-size les-check" checked="">120" or more</label>
      </div>
    </div>
    <h3 class="bh-catalog-filter-heading"><div class="container">Species</div></h3>
    <div class="catalog-filters">
      <div class="container">
        <label class="ash"><input name="les_tree[]" value="ash" type="checkbox" id="ash" class="les-tree les-check" checked="">Ash</label>
        <label class="smaller cherry"><input name="les_tree[]" value="cherry" type="checkbox" id="cherry" class="les-tree les-check" checked="">Cherry</label>
        <label class="smaller easternred"><input name="les_tree[]" value="cedar" type="checkbox" id="cedar" class="les-tree les-check" checked="">Eastern Red Cedar</label>
        <label class="smaller hardmaple"><input name="les_tree[]" value="hard-maple" type="checkbox" id="hard-maple" class="les-tree les-check" checked="">Hard Maple</label>
        <label class="smaller hickory"><input name="les_tree[]" value="hickory" type="checkbox" id="hickory" class="les-tree les-check" checked="">Hickory</label>
        <label class="smaller locust"><input name="les_tree[]" value="locust" type="checkbox" id="locust" class="les-tree les-check" checked="">Black Locust</label>
        <label class="smaller maple"><input name="les_tree[]" value="soft-maple" type="checkbox" id="soft-maple" class="les-tree les-check" checked="">Soft Maple</label>
        <label class="smaller oak"><input name="les_tree[]" value="oak" type="checkbox" id="oak" class="les-tree les-check" checked="">Red Oak</label>
        <label class="smaller sweetgum"><input name="les_tree[]" value="gum" type="checkbox" id="gum" class="les-tree les-check" checked="">Sweet Gum</label>
        <label class="smaller walnut"><input name="les_tree[]" value="walnut" type="checkbox" id="walnut" class="les-tree les-check" checked="">Black Walnut</label>
        <label class="smaller birch"><input name="les_tree[]" value="birch" type="checkbox" id="birch" class="les-tree les-check" checked="">White Birch</label>
        <label class="smaller white-oak"><input name="les_tree[]" value="white-oak" type="checkbox" id="white-oak" class="les-tree les-check" checked="">White Oak</label>
        <label class="smaller pine"><input name="les_tree[]" value="pine" type="checkbox" id="pine" class="les-tree les-check" checked="">White Pine</label>
        <label class="smaller other"><input name="les_tree[]" value="other" type="checkbox" id="other" class="les-tree les-check" checked="">Other</label>
        <!--<label class="smaller all"><input name="les_tree[]" value="all-trees" type="checkbox" checked id="all-trees" class="les-tree les-check" checked>Select All</label>-->      
      </div>
    </div>
  </form>

  <div class="slab-grid" id="slab-grid">
  <?php $args = [
      'post_type' => 'product',
      'posts_per_page' => -1,
      'meta_key' => $sortKey,
      'orderby' => 'meta_value_num',
      'order' => $sortDir,
      'post_status' => 'publish',
      'tax_query' => [
        'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'terms' => array($productCatId),
        ),
      ],
    ];
  $loop = new WP_Query( $args );
  while ( $loop->have_posts() ) {
    $loop->the_post();
    $productId = get_the_ID();
    /* echo '<pre>';
    print_r(get_post_meta($productId));
    echo '</pre>'; */
    $price = get_post_meta( $productId, '_regular_price')[0];
    if(!empty($price)) {
      $price = str_replace('$', '', $price);
    }
    $width = get_post_meta($productId, '_width')[0];
    $thick = get_post_meta($productId, '_height')[0];
    $length = get_post_meta($productId, '_length')[0];
    $byLength = get_post_meta($productId, 'by_length')[0];
    $slabCat = get_post_meta($productId, 'slab_category')[0];
    $tree = get_post_meta($productId, 'by_species')[0];
    $image = get_post_meta( $productId, '_thumbnail_id')[0];
    if($image) {
      $imageLg = wp_get_attachment_image_src($image, 'full_width');
      $image = wp_get_attachment_image_src($image, 'medium_large');
      $image_url = $image[0];
      $imageWidth = $image[1];
      $imageHeight = $image[2];
      $imageAlt = $productCat == 'panels' ? "Bark House poplar bark panel SKU ".get_the_title($productId) : "Bark House live edge slab SKU ".get_the_title($productId);
      $image_url_fullsize = $imageLg[0];
    } ?>

    <div class="col-3 slab <?php echo sanitize_title($productCat).' ';
      if($slabCat === 'Mantles') { echo 'mantle '; } 
      if($slabCat === 'Slabs Rectangular') { echo 'rectangular '; }
      if($slabCat === 'Slabs Irregular') { echo 'irregular '; } 
      if($slabCat === 'Slabs Round') { echo 'round '; } 
      if($byLength === 'Under 72"') { echo 'u72 '; }  
      if($byLength === '72" - 95"') { echo 'u95 '; }  
      if($byLength === '96" - 119"') { echo 'u119 '; }  
      if($byLength === '120" or more') { echo 'o120 '; }
      if($tree === 'Cherry') { echo 'cherry '; } 
      if($tree === 'Ash') { echo 'ash '; }
      if($tree === 'Eastern Red Cedar') { echo 'cedar '; }
      if($tree === 'Hard Maple') { echo 'hard-maple '; }
      if($tree === 'Hickory') { echo 'hickory '; }
      if($tree === 'Locust') { echo 'locust '; }
      if($tree === 'Maple') { echo 'soft-maple '; }
      if($tree === 'Oak') { echo 'oak '; }
      if($tree === 'Sweet Gum') { echo 'gum '; }
      if($tree === 'Walnut') { echo 'walnut '; }
      if($tree === 'White Birch') { echo 'birch '; }
      if($tree === 'White Oak') { echo 'white-oak '; }
      if($tree === 'White Pine') { echo 'pine '; }
      if($tree === 'Other') { echo 'other '; }
    ?>">
      <div class="slab-image">
        <a href="<?= $image_url_fullsize ?>" class="img-wrap image-link" data-title="<?php echo get_the_title(); ?>">
          <?php echo "<div class='the-image' style='background:url($image_url) no-repeat'></div>"; ?>
        </a>
      </div>
      <div class="slab-meta">
        <div class="meta-wrap">
          <h3><?php the_title(); ?></h3>
          <span class="price"><?php if($price) { echo '$'.$price; } else { echo 'please <a href="/contact-us/" target="_blank">contact us</a> for price'; }?></span>
          <div class="meta-inner">
            <div class="col-6 imp">
              <strong>Imperial:</strong><br>
              <?php if($length>0) { ?>
                length = <?= $length ?>" (<?= floor($length / 12)?>'<?php if(($length%12) > 0) { echo ' '.($length%12).'"'; } ?>)<br>
                <?php if($thick) { ?>thickness = <?= $thick ?>"<br><?php } ?>
                avg width = <?= $width ?>" (<?= floor($width / 12)?>'<?php if(($width%12) > 0) { echo ' '.($width%12).'"'; } ?>)<br>
              <?php } else { ?>
                diameter = <?= $width ?>" (<?= floor($width / 12)?>'<?php if(($width%12) > 0) { echo ' '.($width%12).'"'; } ?>)<br>
              <?php if($thick) { ?>thickness = <?= $thick ?>"<?php } ?>
              <br><br>
              <?php } ?>
            </div>
            <div class="col-6 met">
              <strong>Metric:</strong><br>
              <?php 
              echo '<pre>';
              print_r($length);
              echo '</pre>';
              if(intval($length)>0) { ?>
                length = <?= round((intval($length)*.0254), 2, PHP_ROUND_HALF_UP); ?>m<br>
                <?php  if($thick) { ?>thickness = <?= round(($thick*2.54), 3, PHP_ROUND_HALF_UP); ?>cm<br><?php } ?>
                avg width = <?= round(($width*2.54), 3, PHP_ROUND_HALF_UP); ?>cm<br>
              <?php } else {  /* ?>
                diameter = <?= round(($width*.0254), 2, PHP_ROUND_HALF_UP); ?>m<br>
              <?php if($thick) { ?>thickness = <?= round(($thick*2.54), 3, PHP_ROUND_HALF_UP); ?>cm<?php */ } ?>
            </div>
            <span class="sq"></span>
          </div>
        </div>
        <a class="btn-cart" href="<?php echo get_the_permalink($productId); ?>">select slab</a>
      </div>
    </div>
  <?php } ?>
</section>