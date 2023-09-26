<?php $email = get_field('email', 'options');
$phone = get_field('phone', 'options');
$phoneLink = preg_replace('/[^0-9]/', '', $phone);
$address = get_field('street_address', 'options');
$mapLink = get_field('google_maps_link', 'options'); ?>
<div class='contact-links'>
  <div class="col-4 contact-email">
    <?php echo $email ? "<a href='mailto:$email'>$email</a>" : ''; ?>
  </div>
  <div class="col-4 contact-phone">
    <?php echo $phone ? "<a href='tel:+1$phoneLink'>$phone</a>" : ''; ?>
  </div>
  <div class="col-4 contact-address">
    <h3>Bark House<sup>®</sup></h3>
    <?php if($mapLink) {
      echo "<a href='$mapLink' target='_blank'>";
      echo $address ? $address : '';
      echo "</a>";
    } else {
      echo $address ? "<span>$address</span>" : '';
    } ?>
  </div>
</div>