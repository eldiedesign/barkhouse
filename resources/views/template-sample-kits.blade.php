{{--
  Template Name: Sample Kits
--}}

@extends('layouts.app')

<?php 
$intro = get_field('intro');
$args = [
  'post_type'      => 'product',
  'posts_per_page' => -1,
  'tax_query' => [
    [
      'taxonomy'   => 'product_cat',
      'field'      => 'slug',
      'terms'      => 'sample-kits',
    ]
  ]
];
$samples = get_posts($args); ?>

@section('content')
  @while(have_posts()) @php the_post() @endphp
  <?php if($intro) { ?>
      <section class="editor-content">
        <div class="container">
          <?php echo $intro; ?>
        </div>
      </section>
    <?php } ?>
    <section class="products-wrap">
      <div class="container container-wide">
      <div class="product-group">
        <?php if($samples) {
          foreach($samples as $sample) {
            $pLink = $sample->guid;
            $pImg = get_the_post_thumbnail_url($sample->ID, 'medium_large');
            $pDesc = has_excerpt($sample->ID) ? "<p class='brief-description'>{$sample->post_excerpt}</p>" : '';
            echo "<div class='product'>
              <div class='inner'>
                <a href='$pLink' class='img-wrap'>
                  <div class='the-image' style='background:url($pImg) no-repeat'></div>
                </a>
                <h4><a href='$pLink'>{$sample->post_title}</a></h4>
                $pDesc
                <div class='btn-wrap'>
                  <a class='add-to-cart' href='$pLink'>Select Options</a>
                </div>
              </div>
            </div>";
          }
        } ?>
      </div>
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
