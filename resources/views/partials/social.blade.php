<?php $facebook = get_field('facebook', 'options');
$instagram = get_field('instagram', 'options');
$twitter = get_field('twitter', 'options');
$linkedin = get_field('linkedin', 'options');
$site = get_bloginfo('name'); ?>

<ul class="social">
  <?php if($facebook) { echo "<li><a class='facebook' href='$facebook' title='visit $site on Facebook' target='_blank' rel='nofollow'>visit $site on facebook</a></li>"; }
  if($instagram) { echo "<li><a class='instagram' href='$instagram' title='visit $site on Instagram' target='_blank' rel='nofollow'>visit $site on Instagram</a></li>"; }
  if($twitter) { echo "<li><a class='twitter' href='$twitter' title='visit $site on Twitter' target='_blank' rel='nofollow'>visit $site on Twitter</a></li>"; }
  if($linkedin) { echo "<li><a class='linkedin' href='$linkedin' title='visit $site on LinkedIn' target='_blank' rel='nofollow'>visit $site on LinkedIn</a></li>"; } ?>
</ul>