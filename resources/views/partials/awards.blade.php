<?php $awards = get_field('awards');
if($awards) { ?>
  <section class="awards">
    <div class="container">
      <?php foreach($awards as $award) {
        $title = $award['award_title'];
        $year = !empty($award['year']) ? "<h3>{$award['year']}</h3>" : '';
        $desc = !empty($award['description']) ? "<p>{$award['description']}</p>" : '';
        $image = $award['image'];
        echo "<div class='col-4 award'>
          <div class='the-image' style='background:url({$image['sizes']['medium_large']}) no-repeat'></div>
          <h2>$title</h2>
          $year
          $desc
        </div>";
      } ?>
    </div>
  </section>
<?php }