
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
        <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srld') { echo 'checked'; $sortKey = '_height'; $sortDir = 'DESC'; } ?> checked type="radio" value="srld">Height, Descending</label>
        <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srla') { echo 'checked'; $sortKey = '_height'; $sortDir = 'ASC'; } ?> type="radio" value="srla">Height, Ascending</label>
        <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srwd') { echo 'checked'; $sortKey = '_width'; $sortDir = 'DESC'; } ?> type="radio" value="srwd">Width, Descending</label>
        <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srwa') { echo 'checked'; $sortKey = '_width'; $sortDir = 'ASC'; } ?> type="radio" value="srwa">Width, Ascending</label>
        <input type="submit" name="submit" value="sort"/>
        <div class="views">
          <label id="grid-view" title="Grid View" class="active" <?php /* if(isset($panView) && $panView == 'grid') { echo 'class="active"'; } */ ?>><input type="radio" value="grid" name="pan_view" checked <?php if(isset($panView) && $panView == 'grid') { echo 'checked'; } ?>/></label>
          <label id="list-view" title="List View" <?php if(isset($panView) && $panView == 'list') { echo 'class="active"'; } ?>><input type="radio" value="list" name="pan_view" <?php if(isset($panView) && $panView == 'list') { echo 'checked'; } ?>/></label>
        </div>
      </div>
    </div>
    <h3 class="bh-catalog-filter-heading"><div class="container">Height</div></h3>
    <div class="catalog-filters height-filters">
      
      <div class="container">
        <label><input class="height-filter" name="pan_height[]" value="h84" type="checkbox" id="h84" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h84', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>7'</label>	
        <label><input class="height-filter" name="pan_height[]" value="h96" type="checkbox" id="h96" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h96', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>8'</label>
        <label><input class="height-filter" name="pan_height[]" value="h108" type="checkbox" id="h108" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h108', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>9'</label>
        <label><input class="height-filter" name="pan_height[]" value="h120" type="checkbox" id="h120" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h120', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>10'</label>
        <label><input class="height-filter" name="pan_height[]" value="h132" type="checkbox" id="h132" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h132', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>11'</label>
        <label><input class="height-filter" name="pan_height[]" value="h144" type="checkbox" id="h144" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h144', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>12' and taller</label>
      </div>
    </div>
    <h3 class="bh-catalog-filter-heading"><div class="container">Width</div></h3>
    <div class="catalog-filters width-filters">
      <div class="container">
        <label><input type="checkbox" id="wu36" class="width-filter" name="pan_width[]" value="wu36" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu36', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>less than 36"</label>
        <label><input type="checkbox" id="wu42" class="width-filter" name="pan_width[]" value="wu42" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu42', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>36" - 41"</label>
        <label><input type="checkbox" id="wu48" class="width-filter" name="pan_width[]" value="wu48" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu48', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>42" - 47"</label>
        <label><input type="checkbox" id="wu60" class="width-filter" name="pan_width[]" value="wu60" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu60', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>48" to 59"</label>
        <label><input type="checkbox" id="wu72" class="width-filter" name="pan_width[]" value="wu72" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu72', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>60" to 72"</label>
        <label><input type="checkbox" id="wo72" class="width-filter" name="pan_width[]" value="wo72" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wo72', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>72" or more</label>
      </div>
    </div>
    <h3 class="bh-catalog-filter-heading"><div class="container">Grade</div></h3>
    <div class="catalog-filters pan-grade-filter">
      <div class="container">
        <label><input type="checkbox" id="premium" class="pan-grade" name="pan_grade[]" value="premium" <?php if(!empty($_POST)) { if(isset($panGrade) && (in_array('premium', $panGrade))) { echo 'checked'; }  } else { echo 'checked'; } ?>>Premium <span>(greater than 7/8" thickness)</span></label>
        <label><input type="checkbox" id="standard" class="pan-grade" name="pan_grade[]" value="standard" <?php if(!empty($_POST)) { if(isset($panGrade) && (in_array('standard', $panGrade))) { echo 'checked'; }  } else { echo 'checked'; } ?>>Standard <span>(1/2" to 7/8" thickness)</span></label>
        <label><input type="checkbox" id="interior" class="pan-grade" name="pan_grade[]" value="interior" <?php if(!empty($_POST)) { if(isset($panGrade) && (in_array('interior', $panGrade))) { echo 'checked'; }  } else { echo 'checked'; } ?>>Interior <span>(less than 1/2" thickness)</span></label>
      </div>
    </div>
  </form>

  <div class="slab-grid" id="panel-grid">
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
      $price = get_post_meta( $productId, '_regular_price')[0];
      $height = get_post_meta($productId, '_height')[0];
      $width = get_post_meta($productId, '_width')[0];
      $grade = get_post_meta($productId, 'grade')[0];
      $image = get_post_meta( $productId, '_thumbnail_id')[0];
      $scaleWidth = intVal($width)*8;
      $scaleHeight = intVal($height)*8;
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
        if($height == 72 ) { echo 'h72 '; }
        if($height == 84 ) { echo 'h84 '; } 
        if($height == 96 ) { echo 'h96 '; } 
        if($height == 108 ) { echo 'h108 '; } 
        if($height == 120 ) { echo 'h120 '; } 
        if($height == 132 ) { echo 'h132 '; }
        if($height >= 144 ) { echo 'h144 '; } 
        if($width < 36 ) { echo 'wu36 '; } 
        if($width >= 36 && $width < 42 ) { echo 'wu42 '; }
        if($width >= 42 && $width < 48 ) { echo 'wu48 '; }
        if($width >= 48 && $width < 60 ) { echo 'wu60 '; }
        if($width >= 60 && $width <= 72 ) { echo 'wu72 '; }
        if($width > 72 ) { echo 'wo72 '; }
        echo strtolower($grade);
      ?>">
        <div class="slab-image">
          <a href="<?= $image_url_fullsize ?>" class="img-wrap image-link" data-title="<?php echo get_the_title(); ?>">
            <?php echo "<img data-scaleWidth='$scaleWidth' data-scaleHeight='$scaleHeight' src='$image_url' width='$imageWidth' height='$imageHeight' alt='$imageAlt'/>"; ?>
          </a>
          <label class="compare" for="<?php echo sanitize_title(get_the_title()); ?>">Compare <input class="compare-check" type="checkbox" name="<?php echo sanitize_title(get_the_title()); ?>" id="<?php echo sanitize_title(get_the_title()); ?>"/></label>
        </div>
        <div class="slab-meta">
          <div class="meta-wrap">
            <h3><?php the_title(); ?></h3>
            <h4><?= $grade ?> Grade</h4>
            <span class="price"><?php if($price) { echo '$'.$price; } else { echo 'please <a href="/contact-us/" target="_blank">contact us</a> for price'; }?></span>
            <h5 class="grade-description"><?php echo $grade == 'Interior' ? 'typically 3/8” to 1/2” maximum thickness' : '';
              echo $grade == 'Standard' ? 'typically 9/16” to 7/8” maximum thickness' : '';
              echo $grade == 'Premium' ? 'typically 15/16” to 1 1/2” maximum thickness' : '';?></h5>
            <div class="meta-inner">
              <div class="col-6">
                <strong>Imperial:</strong><br>
                width = <?= $width ?>" (<?= floor($width / 12)?>'<?php if(($width % 12) > 0) { echo ' '.($width % 12).'"'; } ?>)<br>
                height = <?= $height ?>" (<?= floor($height / 12)?>'<?php if(($height % 12) > 0) { echo ' '.($height % 12).'"'; } ?>)<br>
                <?= round(((($width*$height)/12)/12), 2, PHP_ROUND_HALF_UP); ?> sq ft
              </div>
              <div class="col-6">
                <strong>Metric:</strong><br>
                width = <?= round(($width*.0254), 2, PHP_ROUND_HALF_UP); ?>m<br>
                height = <?= round(($height*.0254), 2, PHP_ROUND_HALF_UP); ?>m<br>
                <?= round((((($width*.0254)*($height*.0254)))), 2, PHP_ROUND_HALF_UP); ?> sq m
              </div>
              <span class="sq"></span>
            </div>
          </div>
          <a class="btn-cart" href="<?php echo get_the_permalink($productId); ?>">select panel</a>
        </div>
      </div>
    <?php } ?>
    <div id="compare-btn-wrap">
      <button id="compare-selected">compare selected</button>
    </div>
  </div>
</section>


<div id="compare-modal-wrap">
  <button id="close-compare">Close modal window</button>
  <p class="instructions">drag & drop items to rearrange</p>
  <div class="inner modal-wrap-inner"></div>
</div>