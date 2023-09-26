
<?php  $outletName = urlencode(get_the_title($post->ID));
$email = preg_replace("/[^a-zA-Z0-9:;?,.!'“”‘\s]/", "", get_the_title($post->ID));
$outletUrl = urlencode(get_the_permalink($post->ID)); ?>
<div class="share-wrap">
  <h2>SHARE</h2>
  <ul class="share">
    <li>
      <a class="facebook" href="https://www.facebook.com/sharer.php?t=<?= $outletName ?>&amp;u=<?= $outletUrl ?>" onclick="window.open('https://www.facebook.com/sharer.php?t=<?= $outletName ?>&amp;u=<?= $outletUrl ?>','popup','width=600,height=600'); return false;">Facebook</a>
    </li>
    <li>
      <a class="twitter" href="https://twitter.com/intent/tweet?text=<?= $outletName ?>&amp;url=<?= $outletUrl ?>" onclick="window.open('https://twitter.com/intent/tweet?text=<?= $outletName ?>&amp;url=<?= $outletUrl ?>','popup','width=600,height=600'); return false;">Twitter</a>
    </li>
    <li>
      <a class="linkedin" href="https://www.linkedin.com/shareArticle?title=<?= $outletName ?>&amp;url=<?= $outletUrl ?>&amp;mini=true" onclick="window.open('https://www.linkedin.com/shareArticle?title=<?= $outletName ?>&amp;url=<?= $outletUrl ?>&amp;mini=true','popup','width=600,height=600'); return false;">LinkedIn</a>
    </li>
    <li>
      <a class="email" target="_blank" href="mailto:?body=<?= $outletUrl ?>&amp;subject=<?= $email; ?>">Email</a>
    </li>
  </ul>
</div>