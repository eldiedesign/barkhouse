<?php $gallery = get_field('product_gallery');
$galleryLink = get_field('product_gallery_link');
$orderBtn = get_field('catalog_link');
$orderInstructions = get_field('order_instructions');
$catalogExplanation = get_field('catalog_explanation');
$shortDesc = get_field('product_short_description');
$options = get_field('product_options'); // 'option'  'brief_description'
$featImg = get_the_post_thumbnail_url($post->ID, 'medium_large');
$featImgFull = get_the_post_thumbnail_url($post->ID, 'full_width'); ?>

<section class="editor-content woocommerce">
  <div class="product col-12">
    <div class="col-6 product-gallery-wrap">
      <?php echo has_post_thumbnail($post->ID) ? "<a href='$featImgFull' class='img-link' data-caption='".get_the_post_thumbnail_caption($post->ID)."'><div class='the-image' style='background:url($featImg)'></div></a>" : '';
      if($gallery) {
        echo '<div class="product-gallery">';
          foreach($gallery as $img) {
            $caption = $img['caption'];
            $thumb = $img['sizes']['medium'];
            $full = $img['sizes']['full_width'];
            echo "<a class='img-link' href='$full' data-caption='$caption'>
              <div class='the-image' style='background:url($thumb)'></div>
            </a>";
          }
        echo '</div>';
      }
      echo $galleryLink ? "<a class='gallery-link' href='{$galleryLink['url']}'>{$galleryLink['title']}</a>" : '';
      echo $shortDesc ? "<div class='woocommerce-product-details__short-description'>$shortDesc</div>" : '<div class="woocommerce-product-details__short-description"></div>'; ?>
    </div>
    <div class="col-6 summary entry-summary">
      <div class="cart">
        <?php echo $orderInstructions ? "<div class='order-instructions'>$orderInstructions</div>" : '';
        if($options) {
          echo '<h2 class="options clear">Options:</h2>
          <ul class="product-options">';
            foreach($options as $opt) {
              $type = $opt['selection_type'];
              $inputName = str_replace('-', '_', sanitize_title($opt['input_name']));
              $isMulti = $opt['multiple_inputs'];
              $formInput = '';
              if($type == 'radio' || $type == 'dropdown') {
                $choices = $opt['choices'];
                if(!empty($choices)) {
                  if($type == 'radio') {
                    foreach($choices as $choice) {
                      $cDisplay = $choice['choice_display'];
                      $cValue = $choice['choice_value'];
                      $formInput .= "<div class='option-choice-wrap radio'>
                        <label><input type='radio' name='$inputName' value='$cValue'/> $cDisplay</label>";
                      $formInput .= "</div>";
                    }
                  
                  }
                  if($type == 'dropdown') {
                    $formInput .= "<select name='$inputName'>";
                      foreach($choices as $choice) {
                        $cDisplay = $choice['choice_display'];
                        $cValue = $choice['choice_value'];
                        $formInput .= "<option value='$cValue'>$cDisplay</option>";
                      }
                    $formInput .= "</select>";
                  }
                }
              } else {
                $formInput = "<label>{$opt['number_label']} <input type='$type' name='$inputName' class='$inputName'/></label>";
              }
              
              if($inputName == 'panel_size') {
                $formInput .= '<label class="panel_quantity"><input type="number" min="1" pattern="[0-9]" name="panel_quantity"/> Number of Panels</label>
                <p class="complex_order_message"><em>If your order includes multiple panels with different options, please briefly describe your project on the <a class="request-product inline" href="'.$orderBtn['url'].'">next page.</a></em></p>';
              }
              echo "<li class='ihmm-toggle-container order-product-option'>
                <h3 class='option-toggle ihmm-attribute-toggle'>{$opt['option']}</h3>
                <div class='option-description-wrap ihmm-attribute-content'>
                  <div class='option-description inner'>
                    $formInput
                    <div class='brief-description'>{$opt['brief_description']}</div>";
                    if(!empty($choices) && $type == 'radio') {
                      foreach($choices as $choice) {
                        $cDesc = $choice['choice_brief_description'];
                        echo !empty($cDesc) ? "<div class='choice-description'>
                          <h3>{$choice['choice_display']}</h3>
                          $cDesc
                        </div>" : '';
                      }
                    }
                    if($isMulti) {
                      $multiInputs = $opt['multi_input_fields'];
                      if(!empty($multiInputs)) {
                        foreach($multiInputs as $mi) {
                          $type = $mi['multi_input_type'];
                          $desc = $mi['multi_description'];
                          if($type == 'text' || $type == 'number') {
                            echo "<label>{$mi['multi_input_label']} <input type='$type' name='{$mi['multi_input_name']}' class='{$mi['multi_input_name']}'/></label>";
                            echo $desc ? "<div class='multi-indent'>$desc</div>" : '';
                          } else {
                            $choices = $mi['multi_choices'];
                            if($choices) {
                              echo "<strong>{$mi['multi_input_label']}</strong>
                              <div class='multi-indent'>";
                                echo $desc ? $desc : '';
                                foreach($choices as $ch) {
                                  echo "<label>{$ch['choice_display']} <input type='$type' name='{$mi['multi_input_name']}' value='{$ch['choice_value']}' class='{$mi['multi_input_name']}'/></label>";
                                }
                              echo '</div>';
                            }
                          }
                        }
                      }
                    }
                  echo "</div>
                </div>
              </li>";
            }
          echo '</ul>';
        }
        echo "<input type='hidden' value='{$post->post_name}' id='slug'/>";
        echo $orderBtn ? "<a class='request-product' href='{$orderBtn['url']}'>{$orderBtn['title']}</a>" : '';
        echo $catalogExplanation ? "<div class='catalog-explanation'>$catalogExplanation</div>" : ''; ?>
      </div>
    </div>
    @include('woocommerce.single-product.tabs.tabs')
  </div>
</section>