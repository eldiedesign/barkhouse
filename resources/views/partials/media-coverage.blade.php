<?php $active = '';
if(is_page('blogs')) {
  $active = 'blog-gallery';
}
if(is_page('tv')) {
  $active = 'tv';
}
if(is_page('magazines')) {
  $active = 'magazine-gallery';
}
if(is_page('books')) {
  $active = 'books';
} ?>

<section class="press-header">
  <div class="container">
    <ul class="news-subnav">
      <li><a <?php echo $active == 'magazine-gallery' ? 'class="active"' : ''; ?> href="/as-seen-in/magazines/">Magazines</a></li>
      <li><a <?php echo $active == 'books' ? 'class="active"' : ''; ?> href="/as-seen-in/books/">Books</a></li>
      <li><a <?php echo $active == 'blog-gallery' ? 'class="active"' : ''; ?> href="/as-seen-in/blogs/">Blogs</a></li>
      <li><a <?php echo $active == 'tv' ? 'class="active"' : ''; ?> href="/as-seen-in/tv/">TV</a></li>
    </ul>
  </div>
</section>

<section class="media-coverage">
  <?php // magazines need pic and pdf link
  // books is a page - open editor
  // blogs needs description and pdf
  // tv needs screenshot and description
  
  if($active == 'books') { ?>
    @include('partials.content-page')
  <?php } else {
    $args = [
      'posts_per_page' => -1,
      'post_type' => $active
    ];
    $the_query = new WP_Query( $args );
    while ($the_query->have_posts()) {
      $the_query->the_post();
      $id = get_the_ID();
      $pdf = '';
      $desc = ($active == 'blog-gallery' || $active == 'tv') ? get_Field('brief_description', $id) : false;
      if($active == 'magazine-gallery') {
        $pdf = get_field('wpcf-magazine-pdf', $id); 
      }
      if($active == 'blog-gallery') {
        $pdf = get_field('blog_pdf', $id);
      }
      if($active == 'tv') {
        $pdf = get_the_post_thumbnail_url($id, 'full');
      } ?>
      <div class="col-3 <?= $active ?>">
        <a class="<?php echo $active == 'tv' ? 'img-popup' : 'iframe-popup'; ?> img-wrap" href="<?= $pdf ?>" <?php echo $active == 'tv' ? 'data-caption = "'. get_post(get_post_thumbnail_id($id))->post_excerpt .'"' : ''; ?>>
          <div class="the-image" style="background:url(<?= get_the_post_thumbnail_url($id, 'medium_large'); ?>) no-repeat"></div>
          <span>view pdf</span>
        </a>
        <div class="meta-wrap">
          <h2><?= get_the_title($id); ?></h2>
          <?php echo $desc ? "<p class='description'>$desc</p>" : ''; ?>
        </div>
      </div>
    <?php }
  } ?>
</section>