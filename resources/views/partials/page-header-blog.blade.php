<section class="page-header">
  <div class="container">
    <h1>{!! App::title() !!}</h1>
    <?php $qo = get_queried_object();
    $currentCat = $qo->name; ?>
    <div class="cat-filter-wrap">
      <select id="cat-filter">
        <?php $cats = get_categories();
        echo "<option value='/blog/'>All Categories</option>";
        foreach($cats as $cat) {
          $name = $cat->name;
          $link = site_url()."/category/{$cat->slug}";
          if($name == $currentCat) {
            echo "<option selected value='$link'>$name  ({$cat->category_count})</option>";
          } else {
            echo "<option value='$link'>$name  ({$cat->category_count})</option>";
          }
        } ?>
      </select>
    </div>
  </div>
</section>