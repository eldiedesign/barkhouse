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
  <div class="container">
    @include('partials.content-page')
  </div>
</section>