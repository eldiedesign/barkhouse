<?php $awardsHeading = get_field('awards_heading');
$awards = get_field('awards');

if($awards) { ?>
  <section class="home-awards">
    <div class="container">
      <?php echo $awardsHeading ? "<h2>$awardsHeading</h2>" : ''; ?>
      <div class="the-awards">
        <?php foreach($awards as $award) {
          echo "<div class='award'>
            <h3 class='sr-only'>{$award['award_title']}</h3>
            <div class='the-image' style='background:url({$award['award_image']['sizes']['medium']}) no-repeat'></div>
          </div>";
        } ?>
      </div>
    </div>
  </section>
<?php }