<?php $specs = get_field('specifications', $post->ID);
$buyersGuide = get_field('buyers_guide', $post->ID);
$description = is_singular('product') ? get_the_content($post->ID) : get_field('full_description', $post->ID);
$productGuide = get_field('product_guide_and_installation', $post->ID);
$faqs = get_field('faqs', $post->ID);
$storage = get_field('storage_and_handling', $post->ID);
$terms = get_the_terms($post->ID, 'product_cat');
$cat = !empty($terms) ? $terms[0]->slug : '';
$theTabs = [];
if($cat == 'sample-kits') { // FAQ's first...
  $theTabs['faqs'] = $faqs ? ['tab_content' => $faqs, 'tab_title' => 'FAQ’s'] : false;
  $theTabs['specifications'] = $specs ? ['tab_content' => $specs, 'tab_title' => 'Specifications'] : false;
  $theTabs['full_description'] = !empty(get_the_content($post->ID)) || $description ? ['tab_content' => true, 'tab_title' => 'Full Description'] : false;
  $theTabs['product_guide'] = $productGuide ? ['tab_content' => $productGuide, 'tab_title' => 'Product Guide and Installation'] : false;
  
} else {
  $theTabs['specifications'] = $specs ? ['tab_content' => $specs, 'tab_title' => 'Specifications'] : false;
  $theTabs['full_description'] = !empty(get_the_content($post->ID)) || $description ? ['tab_content' => true, 'tab_title' => 'Full Description'] : false;
  $theTabs['product_guide'] = $productGuide ? ['tab_content' => $productGuide, 'tab_title' => 'Product Guide and Installation'] : false;
  $theTabs['faqs'] = $faqs ? ['tab_content' => $faqs, 'tab_title' => 'FAQ’s'] : false;
}
$theTabs['storage'] = $storage ? ['tab_content' => $storage, 'tab_title' => 'Storage and Handling'] : false; ?>

<div class="woocommerce-tabs wc-tabs-wrapper">
  <ul class="tabs wc-tabs" role="tablist">
    <?php $y = 0;foreach ( $theTabs as $key => $tab) {
      if($tab) { ?>
        <li class="product-tab <?php echo $t == 1 ? 'active' : ''; ?>" data-tab="#tab-<?php echo esc_attr( $key ); ?>">
          <a href="#tab-<?php echo esc_attr( $key ); ?>"><?= $tab['tab_title'] ?></a>
        </li>
      <?php }
    } ?>
  </ul>
  <?php $t = 0;
  foreach ( $theTabs as $key => $tab ) {
    if($tab) { ?>
      <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab <?php echo $t == 0 ? 'active' : ''; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
        <?php if($key == 'full_description') {
          echo $description;
        } elseif($key == 'faqs') {
          $faqs = $tab['tab_content'];
          if(!empty($faqs)) {
            echo $faqs;
           /*  foreach($faqs as $faq) {
            echo "<div class='faq-wrap ihmm-toggle-container'>
              <h3 class='faq-toggle ihmm-attribute-toggle'>{$faq['question']}</h3>
              <div class='faq-content ihmm-attribute-content'>
                <div class='inner'>
                  {$faq['answer']}
                </div>
              </div>
            </div>";
            } */
          }
        } else {
          echo $tab['tab_content'];
        } ?>
      </div>
      <?php $t++;
    }
  } ?>
  <?php do_action( 'woocommerce_product_after_tabs' ); ?>
</div>