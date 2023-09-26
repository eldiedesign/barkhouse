<?php $videos = get_field('videos');
if($videos) { ?>
  <section class="videos">
    <div class="video-grid">
      <?php $n = 1;
      foreach($videos as $vid) {
        $videoTitle = $vid['video_title'];
        $video = $vid['video']; 
        $videoId = str_replace('watch?v=', 'embed/', $video); ?>
        <div class="col-4 the-video">
          <a class="video-link" id="video-<?= $n ?>" href="<?= $video; ?>?rel=0&autoplay=0&loop=0&wmode=opaque">
            <div class="iframe-wrap">
              <iframe width="370" height="207" src="<?= $videoId ?>?rel=0&modestbranding=1&controls=0&autohide=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <h2><?= $videoTitle ?></h2>
          </a>
        </div>
        <?php $n++;
      } ?> 
    </div>
  </section>
<?php }