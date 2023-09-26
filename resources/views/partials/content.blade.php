<?php global $post;
$fallback = get_field('blog_default_image', 'options') ? get_field('blog_default_image', 'options')['sizes']['medium_large'] : '';
$cat = get_the_category($post->ID);
if(has_post_thumbnail($post->ID)) {
  $archiveImage = get_the_post_thumbnail_url($post->ID, 'medium_large');
} else {
  $archiveImage = $fallback;
} ?>
<article @php post_class() @endphp>
  <div class="inner">
    <a class="img-wrap" href="{{ get_permalink() }}">
      <div class="the-thumb" style="background:url(<?= $archiveImage ?>)"></div>
    </a>
    <div class="meta">
      <div class="col-5 date">
        <span><?= get_the_date('F d, Y', $post->id); ?></span>
      </div>
      <div class="col-7 cat">
        <a href="/category/<?= $cat[0]->slug ?>/"><?= $cat[0]->name ?></a>
      </div>
    </div>
    <div class="entry-content">
      <h3 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h3>
      <p class="the-excerpt"><?= get_the_excerpt($post->ID); ?></p>
    </div>
  </div>
</article>