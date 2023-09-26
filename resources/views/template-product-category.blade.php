{{--
  Template Name: Product Category
--}}

@extends('layouts.app')

<?php 
//$headingTop = get_field('heading_top');
//$headingTop = str_replace('p>', 'h2>', $headingTop);
//$headingLower = get_field('heading_lower');
//$headingLower = str_replace('p>', 'h2>', $headingLower);
$productGroups = get_field('product_groups'); ?>

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <section class="products-wrap">
      <div class="container container-wide">
        <?php // filter thing goes here
        if($productGroups) {
          foreach($productGroups as $group) {
            $groupTitle = $group['group_title'];
            $products = $group['products'];
            $productCount = count($products);
            echo "<div class='product-group count-$productCount'>";
            echo !empty($groupTitle) ? "<h3>$groupTitle</h3>" : '';
              if($products) {
                foreach($products as $product) {
                  $pLink = $product['product_link'];
                  $pImg = $product['product_image'];
                  $pDesc = !empty($product['product_description']) ? "<p class='product-description'>{$product['product_description']}</p>" : '';
                  echo "<div class='product'>
                    <div class='inner'>
                      <a href='{$pLink['url']}' class='img-wrap'>
                        <div class='the-image' style='background:url({$pImg['sizes']['medium_large']}) no-repeat'></div>
                      </a>
                      <h4><a href='{$pLink['url']}'>{$pLink['title']}</a></h4>
                      $pDesc
                    </div>
                  </div>";
                }
              }
            echo "</div>";
          }
        } ?>
      </div>
    </section>
    @include('partials.cta-banner')
 
    <section class="products-content">
      <?php $featureBg = get_field('feature_background');
      $headingFeature = get_field('feature_heading');
      $headingFeature = str_replace('p>', 'h2>', $headingFeature);
      $lowerContent = get_field('lower_content');
      $lowerVideo = get_field('lower_video');
      if($featureBg) {
        echo "<div class='products-feature' style='background:url({$featureBg['sizes']['full_width']}) no-repeat'>";
          echo $headingFeature ? "<div class='feature-heading'><div class='container'>$headingFeature</div></div>" : '';
        echo "</div>";
      } else {
        echo $headingFeature ? "<div class='feature-heading'><div class='container'>$headingFeature</div></div>" : '';
      }
      if($lowerContent) { ?>
        <div class="container lower-content">
          <?php echo $lowerContent ? $lowerContent : '';
          echo $lowerVideo ? $lowerVideo : ''; ?>
        </div>
      <?php } ?>
    </section>
  @endwhile
@endsection
