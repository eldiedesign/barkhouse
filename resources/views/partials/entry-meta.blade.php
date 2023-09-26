<?php $authorID = get_the_author_meta($post->ID);
$cats = get_the_category(); ?>

<div class="byline author vcard">
  <div class="col-5">
    <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
    <div class="the-author">By {{ get_the_author() }}</div>
  </div>
  <div class="col-7">
    <?php foreach($cats as $cat) { echo "<a class='post-cat' href='/category/{$cat->slug}/'>{$cat->name}</a>"; } ?>
  </div>
</div>