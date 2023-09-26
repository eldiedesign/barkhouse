<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */


defined( 'ABSPATH' ) || exit;

global $product;
$cat = $product->get_category_ids()[0];

if ( ! $product->is_purchasable() ) {
  return;
}
if($cat == '263') { // poplar panels ?>
  @include('woocommerce.single-product.panel-info')
<?php }
echo '<h2 class="options">Options:</h2>';

if ( $product->is_in_stock() ) : ?>

  <?php //do_action( 'woocommerce_before_add_to_cart_form' );
  if($cat != '270' && $cat != '263') {
    echo wc_get_stock_html( $product );
  } 
  if($cat == '270') { // live edge slabs
    $width = get_post_meta($post->ID, '_width')[0];
    $thick = get_post_meta($post->ID, '_height')[0];
    $length = get_post_meta($post->ID, '_length')[0];
    $byLength = get_post_meta($post->ID, 'by_length')[0];
    $slabCat = get_post_meta($post->ID, 'slab_category')[0];
    $tree = get_post_meta($post->ID, 'by_species')[0];
    ?>
    <div class="clear"></div>
    <ul class="product-options">
       <li>
        <h3>Height & Width:</h3>
        <div class="option-description col-12">
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
        </div>
      </li>
      <li>
        <h3>Species:</h3>
        <div class="option-description">
          <strong><?= $tree; ?></strong>
        </div>
      </li>
      <li>
        <h3>Type of Slab:</h3>
        <div class="option-description">
          <strong><?= str_replace('Slabs ', '', $slabCat); ?></strong>
        </div>
      </li>
      <li>
        <h3>Shipping:</h3>
        <div class="option-description">
          <strong>Pickup only or call for custom quote.</strong>
          <p>Due to the expense of shipping large, heavy, irregular items, we encourage you to plan to pick up your slab or mantel at our shop.  However, we can provide a custom shipping quote at your request or work with your freight carrier.</p>
        </div>
      </li>
    </ul>
  <?php }
  
/*<ul class="product-options">
      <li class="ihmm-toggle-container">
        <h3 class="option-toggle ihmm-attribute-toggle">Height &amp; Width</h3>
        <div class="option-description-wrap ihmm-attribute-content" style="height: 0px;">
          <div class="option-description inner">
            <p>The Poplar Panels range from 7’ tall to over 12’ in one-foot increments, allowing you endless possibilities to make your project vision a reality.</p>
            <p>The widths of the panels vary between 24” to more than 72”.&nbsp; Because bark is a natural material, it has as many variables as you would find in the forest. We honor the strategy of nature with minimal waste, so we save as much of the solid sheet of bark as possible.&nbsp; This means that not all widths may be found with all heights. Keep the creativity of nature in mind as you search for your perfect panel width.</p>
            <p>All sizes are subject to availability.</p>
          </div>
        </div>
      </li>
      <li class="ihmm-toggle-container">
        <h3 class="option-toggle ihmm-attribute-toggle">Grade</h3>
        <div class="option-description-wrap ihmm-attribute-content" style="height: 0px;">
          <div class="option-description inner">
            <p>The thickness, or grade, you choose may be a requirement of your application or simply a design choice.&nbsp; In every panel, there will be a slight range in the thickness as this is a natural material with unique characteristics. While interior grade is only to be used inside, Premium and Standard grades are thicker and appropriate for exterior applications when laminated to an exterior-grade substrate by our fabrication team.&nbsp; All grades are subject to availability.</p>
          </div>
        </div>
      </li>
      <li class="ihmm-toggle-container">
        <h3 class="option-toggle ihmm-attribute-toggle">Substrate</h3>
        <div class="option-description-wrap ihmm-attribute-content">
          <div class="option-description inner">
            <p>Bark House® Poplar Panel Wall Coverings can be laminated to any substrate of your preference including exterior-grade Extira or Hardi Board (one is required for exterior applications).&nbsp;&nbsp;<strong>The natural grain of the bark will be oriented to the measurement that you give us for the HEIGHT</strong>.&nbsp;&nbsp;<u>This is a customization option that may require speaking with our staff expert</u>.</p>
          </div>
        </div>
      </li>
      <li class="ihmm-toggle-container">
        <h3 class="option-toggle ihmm-attribute-toggle">Finish</h3>
        <div class="option-description-wrap ihmm-attribute-content">
          <div class="option-description inner">
            <p>Adding a clear finish to the material helps the grain stand out on sanded bark, offering a rich background of varied tones and swirls.&nbsp; Paint treatments add even more drama and customization options.</p>
          </div>
        </div>
      </li>
    </ul>
  <?php }*/  ?>

  <form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
    <?php $attributeDescriptions = get_field('attribute_descriptions', 'product_cat_263'); 
    if($attributeDescriptions) {
      echo '<div id="ihmm-descriptions">';
        foreach($attributeDescriptions as $desc) {
          echo "<div class='ihmm-desc' data-attribute='{$desc['attribute_name']}'>{$desc['attribute_description']}</div>";
        }
      echo '</div>';
    }
    do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <?php do_action( 'woocommerce_before_add_to_cart_quantity' );

    woocommerce_quantity_input(
      array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
      )
    );

    do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>

    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
  </form>

  <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
