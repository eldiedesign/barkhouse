<article @php post_class() @endphp>
  <header>
    <h1 class="entry-title"><?= wp_specialchars_decode(get_the_title()); ?></h1>
    @include('partials/entry-meta')
    <?php the_post_thumbnail($post->ID, 'large'); ?>
  </header>
  <div class="entry-content">
    <?php 

/* 
echo '<pre>';
print_r(get_post_meta($post->ID));
echo '</pre>'; */

    ?>
    @php the_content() @endphp
    <footer>
      <div class="posts-navigation-wrap">
        <div class="col-6 nav-previous"><?php previous_post_link('%link', 'next post >'); ?></div>
        <div class="col-6 nav-next"><?php next_post_link('%link', '< previous post'); ?></div>
      </div>
    </footer>
  </div>
</article>