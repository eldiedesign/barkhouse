<?php $recs = get_field('recognitions');
if($recs) { ?>
  <section class="home-recognition">
    <?php foreach($recs as $rec) {
      $rDesc = $rec['rec_desc'];
      $rImages = $rec['award_images'];
      $aDesc = $rec['awards_brief_description']; ?>
      <div class="col-4">
        <h2><?= $rec['rec_title']; ?></h2>
        <?php echo $rDesc ? "<p class='rec-desc'>{$rDesc}</p>" : '';
        if($rImages) {
          foreach($rImages as $img) {
            echo "<img src='{$img['image']['sizes']['medium']})' width='{$img['image']['sizes']['medium-width']}' height='{$img['image']['sizes']['medium-height']}' alt='{$img['image']['alt']}'/>";
          }
        }
        echo $aDesc ? "<p class='awards-desc'>{$aDesc}</p>" : ''; ?>
      </div>
    <?php } ?>
  </section>
<?php }