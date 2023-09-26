{{--
  Template Name: All Products
--}}

@extends('layouts.app')

<?php 
$headingTop = get_field('heading_top');
$headingTop = str_replace('p>', 'h2>', $headingTop);
$headingLower = get_field('heading_lower');
$headingLower = str_replace('p>', 'h2>', $headingLower);
$headingSamples = get_field('heading_samples');
$headingSamples = str_replace('p>', 'h2>', $headingSamples);
$productGroups = get_field('product_groups'); ?>

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <?php $introContent = get_field('text_content');
    if($introContent) { ?>
      <section class="editor-content">
        <div class="container">
          <?php echo $introContent; ?>
        </div>
      </section>
    <?php } ?>
    <section class="products-wrap">
      <header>
        <div class="container">
          <?= $headingTop; ?>
        </div>
      </header>
      <div class="container container-wide">
        <?php // filter thing goes here
        if($productGroups) {
          foreach($productGroups as $group) {
            $groupTitle = $group['group_title'];
            $products = $group['products'];
            $productCount = count($products);
            echo "<div class='product-group count-$productCount'>
            <h3>$groupTitle</h3>";
              if($products) {
                foreach($products as $product) {
                  $pLink = $product['product_link'];
                  $pImg = $product['product_image'];
                  echo "<div class='product'>
                    <div class='inner'>
                      <a href='{$pLink['url']}' class='img-wrap'>
                        <div class='the-image' style='background:url({$pImg['sizes']['medium_large']}) no-repeat'></div>
                      </a>
                      <h4><a href='{$pLink['url']}'>{$pLink['title']}</a></h4>
                    </div>
                  </div>";
                }
              }
            echo "</div>";
          }
        } ?>
      </div>
    </section>
    <section class="products-wrap solid-wood">
      <header>
        <div class="container">
          <?= $headingLower; ?>
        </div>
      </header>
      <div class="container container-wide">
        <?php $solidProducts = get_field('solid_products');
        if($solidProducts) {
          $solidProductCount = count($solidProducts);
          echo "<div class='product-group count-$solidProductCount'>";
            if($solidProducts) {
              foreach($solidProducts as $product) {
                $pLink = $product['product_link'];
                $pImg = $product['product_image'];
                echo "<div class='product'>
                  <div class='inner'>
                    <a href='{$pLink['url']}' class='img-wrap'>
                      <div class='the-image' style='background:url({$pImg['sizes']['medium']}) no-repeat'></div>
                    </a>
                    <h4><a href='{$pLink['url']}'>{$pLink['title']}</a></h4>
                  </div>
                </div>";
              }
            }
          echo "</div>";
        } ?>
      </div>
    </section>

    <section class="products-wrap samples">
      <header>
        <div class="container">
          <?= $headingSamples; ?>
        </div>
      </header>
      <div class="container container-wide">
        <?php $sampleProducts = get_field('samples');
        if($sampleProducts) {
          $solidProductCount = count($sampleProducts);
          echo "<div class='product-group count-$solidProductCount'>";
            if($sampleProducts) {
              foreach($sampleProducts as $product) {
                $pLink = $product['product_link'];
                $pImg = $product['product_image'];
                echo "<div class='product'>
                  <div class='inner'>
                    <a href='{$pLink['url']}' class='img-wrap'>
                      <div class='the-image' style='background:url({$pImg['sizes']['medium']}) no-repeat'></div>
                    </a>
                    <h4><a href='{$pLink['url']}'>{$pLink['title']}</a></h4>
                  </div>
                </div>";
              }
            }
          echo "</div>";
        } ?>
      </div>
    </section>

    <?php //@include('partials.cta-banner') ?>
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
