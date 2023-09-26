<div class="miles-wrap container">
  <div class="col-3 timeline-wrap">
    <div id="leaf" class="top"></div>
    <div id="timeline">
      <?php $a = 0;
      while( have_rows('milestone_year') ): the_row();
        $year = get_sub_field('year');
        $active = $a == 0 ? 'active ' : ''; ?>
        <div class="milestone-year">
          <a data-slide-index="<?= $a ?>" data-year="<?= $year ?>" class="miles-pager <?php echo $active; if(substr($year, -1) === '0') { echo 'decade'; } ?>" href="#"><?= $year ?></a>
        </div>
        <?php $a++;
      endwhile; ?>
    </div>
  </div>
  <div class="col-9 the-milestones">
    <div id="milestone-slider">
      <?php $b = 0;
      while( have_rows('milestone_year') ): the_row();
        $year = get_sub_field('year');
        $active = $b == 0 ? 'active ' : ''; ?>
        <div class="milestone <?php echo $active; echo 'y'.$year ?>" slide="<?= $b-1 ?>" data-year="<?= $year ?>">
        <?php while( have_rows('milestones') ): the_row(); 
          $title = get_sub_field('m_title');
          $subtitle = get_sub_field('subtitle');
          $desc = get_sub_field('description');
          $images = get_sub_field('images');
          $image_url = $images['sizes']['large'];
          $b++; ?>
          <div class="stone">
            <?php if( $images ) { ?>
              <img src="<?= $image_url; ?>" alt="<?= $images['alt']; ?>" width="<?= $images['width']; ?>" height="<?= $images['height']; ?>"/></li>
            <?php } ?>
            <h3 class="slide-meta"><?= $title ?><?php if($subtitle) { echo "<span class='subtitle'>$subtitle</span>"; } echo "<span class='milestone-year'>$year</span>"?></h3>
            <?php if($desc) { echo $desc; } ?>
          </div>
        <?php endwhile ?>
      </div>
      <?php endwhile ?>
    </div>
  </div>
</div>

<?php $videoTitle = get_field('video_title');
$video = get_field('video'); ?>

<?php if($video) { ?>
  <section class="video">
    <div class="container">
      <div class="video-container">
        <?php if($videoTitle) { ?><h3><?= $videoTitle ?></h3><?php } ?>
        <iframe width="370" height="207" src="//www.youtube.com/embed/<?= $video ?>?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </section>
<?php }