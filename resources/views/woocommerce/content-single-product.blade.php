<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;
global $product;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
$terms = get_the_terms($post->ID, 'product_cat');
$cat = !empty($terms) ? $terms[0]->slug : ''; ?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class($product); ?>>
  <div class="col-6 product-gallery-wrap">
    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action( 'woocommerce_before_single_product_summary' );
    woocommerce_template_single_excerpt(); ?>
    
  </div>
	<div class="col-6 summary entry-summary">
		<?php 

		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5    wc_get_template( 'single-product/title.php' );
		 * @hooked woocommerce_template_single_rating - 10  if ( post_type_supports( 'product', 'comments' ) ) {	wc_get_template( single-product/rating.php' ); }
		 * @hooked woocommerce_template_single_price - 10  	wc_get_template( 'single-product/price.php' );
		 * @hooked woocommerce_template_single_excerpt - 20  wc_get_template( 'single-product/short-description.php' );
		 * @hooked woocommerce_template_single_add_to_cart - 30  global $product; do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
		 * @hooked woocommerce_template_single_meta - 40  wc_get_template( 'single-product/meta.php' );
		 * @hooked woocommerce_template_single_sharing - 50  wc_get_template( 'single-product/share.php' );
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
    woocommerce_template_single_price();
    global $product; do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
    wc_get_template( 'single-product/meta.php' );
    wc_get_template( 'single-product/share.php' );
    $sData = new WC_Structured_Data;
    $sData->generate_product_data(); ?>
    <div class="currency-switcher-wrap">
      <?php echo $cat == 'panels' ? "<a data-product-id='{$post->ID}' href='/poplar-bark-panel-catalog/order-poplar-bark-panel-wall-coverings/?panels=".get_the_title($post->ID)."' id='quote-form-btn'>Add this panel to my order</a>" : ''; ?>
      <?php echo $cat == 'live-edge-slabs' ? "<a data-product-id='{$post->ID}' href='/live-edge-slab-catalog/order-live-edge-slabs/?slabs=' id='quote-form-btn'>Add this slab to my order</a>" : ''; ?>
      <h3>Switch Currency</h3>
      <?php // echo do_shortcode('[woocommerce-currency-switcher format="{{code}}: ({{symbol}})"]'); ?>
      <?php echo do_shortcode('[woocommerce-currency-switcher format="{{code}}"]'); ?>
    </div>

		<?php //do_action( 'woocommerce_single_product_summary' ); ?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10  wc_get_template( 'single-product/tabs/tabs.php' );
	 * @hooked woocommerce_upsell_display - 15  see wc-tempalte-functions.php
	 * @hooked woocommerce_output_related_products - 20  see wc-tempalte-functions.php
	 */
	do_action( 'woocommerce_after_single_product_summary' );
  
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
