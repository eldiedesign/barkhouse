<?php $medCat = get_field('media_category');
if($medCat) {
	// 	$children = get_term_children($medCat, 'media_category');

	// 9.14.2023 - JT
	$mediaCategoryTerms = get_terms( 'media_category', array( 'child_of' => $medCat ) );
	usort($mediaCategoryTerms, function ($a, $b) {
		return strcmp($a->name, $b->name);
	});

	$term_slug = $mainTerm->slug;
	$args = array(
		'post_type'         => 'attachment',
		'posts_per_page'    => -1,
		'fields' => 'ids',
		'tax_query' => array(
			array(
				'taxonomy' => 'media_category',
				'field'    => 'slug',
				'terms'    => $term_slug,
			),
		),
	);
	$photos = get_posts($args);

	
	//  if($children) {
	if($mediaCategoryTerms) {
		echo '<ul class="gallery-toc">';
		//	foreach($children as $termId) {
		foreach($mediaCategoryTerms as $term) {
		//	$term = get_term($termId, 'media_category');
			echo "<li><a href='#gallery-{$term->slug}'>{$term->name}</a></li>";
		}
		echo '</ul>';


		//	foreach($children as $termId) {
		foreach($mediaCategoryTerms as $term) {
		//	$term = get_term($termId, 'media_category');

			$args = array(
				'post_type'         => 'attachment',
				'posts_per_page'    => -1,
				'fields' => 'ids',
				'tax_query' => array(
					array(
						'taxonomy' => 'media_category',
						'field'    => 'slug',
						'terms'    => $term->slug,
					),
				),
			);
			$photos = get_posts($args);
			if($photos) {
				echo "<div class='gallery-wrap'>
				  <h2 class='gallery-title'>{$term->name}</h2>
				  <ul class='the-product-gallery' id='gallery-{$term->slug}'>";
						foreach($photos as $imgId) {
							$img = wp_get_attachment_url($imgId, 'medium_large');
							$imgFull = wp_get_attachment_url($imgId, 'full');
							$cap = wp_get_attachment_caption($imgId);
							echo "<li>
					  <a class='gallery-popup' href='$imgFull' data-caption='$cap'>
						<div class='the-image' style='background:url($img) no-repeat'></div>
					  </a>
					</li>";
				}
				echo '</ul></div>';
			}
		}
	} else {
		$mainTerm = get_term($medCat, 'media_category');
		$args = array(
			'post_type'         => 'attachment',
			'posts_per_page'    => -1,
			'fields' => 'ids',
			'tax_query' => array(
				array(
					'taxonomy' => 'media_category',
					'field'    => 'slug',
					'terms'    => $mainTerm->slug,
				),
			),
		);
		// 	  echo '<pre style="display:none;">' . print_r($mainTerm, true) . '</pre>';
		$photos = get_posts($args);
		if($photos) {
			echo "<div class='gallery-wrap'>
        <h2 class='gallery-title'>{$term->name}</h2>
        <ul class='the-product-gallery' id='gallery-{$term->slug}'>";
			foreach($photos as $imgId) {
				$img = wp_get_attachment_url($imgId, 'medium_large');
				$imgFull = wp_get_attachment_url($imgId, 'full');
				$cap = wp_get_attachment_caption($imgId);
				echo "<li>
            <a class='gallery-popup' href='$imgFull' data-caption='$cap'>
              <div class='the-image' style='background:url($img) no-repeat'></div>
            </a>
          </li>";
			}
			echo '</ul>
      </div>';
		}
	}
}