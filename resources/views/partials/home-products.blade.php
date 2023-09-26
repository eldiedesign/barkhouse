<?php $bannerLine = get_field('banner_text_line');
$products = get_field('home_products');
$prodHeading = get_field('products_heading');
if($products) { ?>
  <section class="home-products">
    <div class="container">
      <?php echo $bannerLine ? "<blockquote>$bannerLine</blockquote>" : '';
      echo $prodHeading ? "<h2>$prodHeading</h2>" : ''; ?>
    </div>
    <div class="the-products">
      <?php foreach($products as $product) {
        $link = $product['product_link'];
        $image = $product['product_image'];
        echo "<div class='home-product col-3'>
          <a class='img-wrap' href='{$link['url']}' title='{$link['title']}' target='{$link['target']}'><div class='the-image' style='background:url({$image['sizes']['medium_large']}) no-repeat'></div></a>
          <a class='product-link' href='{$link['url']}' target='{$link['target']}'>{$link['title']}</a>
        </div>";
      } ?>
    </div>
  </section>
<?php }