<?php $panHeight = $_POST['pan_height'];
$panWidth = $_POST['pan_width'];
$panGrade = $_POST['pan_grade'];
$panel_sort = $_POST['panel_sort'];
$sortKey = 'height'; 
$sortDir = 'DESC';
$panView = $_POST['pan_view']; 
echo '<pre>';
print_r($_POST);
echo '</pre>';
?>

<form method="post" class="sorting-form">
  <h3 class="bh-catalog-filter-heading"><div class="container">Sorting</div></h3>
  <div class="catalog-filters sorta">
    <div class="container">
      <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srld') { echo 'checked'; $sortKey = 'height'; $sortDir = 'DESC'; } ?> checked type="radio" value="srld">Height, Descending</label>
      <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srla') { echo 'checked'; $sortKey = 'height'; $sortDir = 'ASC'; } ?> type="radio" value="srla">Height, Ascending</label>
      <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srwd') { echo 'checked'; $sortKey = 'width'; $sortDir = 'DESC'; } ?> type="radio" value="srwd">Width, Descending</label>
      <label><input class="les-cats les-sort" name="panel_sort" <?php if(isset($panel_sort) && $panel_sort == 'srwa') { echo 'checked'; $sortKey = 'width'; $sortDir = 'ASC'; } ?> type="radio" value="srwa">Width, Ascending</label>
      <input type="submit" name="submit" value="sort"/>
      <div class="views">
        <label id="grid-view" title="Grid View" <?php if(isset($panView) && $panView == 'grid') { echo 'class="active"'; } ?>><input type="radio" value="grid" name="pan_view" checked <?php if(isset($panView) && $panView == 'grid') { echo 'checked'; } ?>/></label>
        <label id="list-view" title="List View" <?php if(isset($panView) && $panView == 'list') { echo 'class="active"'; } ?>><input type="radio" value="list" name="pan_view" <?php if(isset($panView) && $panView == 'list') { echo 'checked'; } ?>/></label>
      </div>
    </div>
  </div>
  <h3 class="bh-catalog-filter-heading"><div class="container">Height</div></h3>
  <div class="catalog-filters height-filters">
    
    <div class="container">
      <label><input class="height-filter" name="pan_height[]" value="h84" type="checkbox" id="h84" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h84', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>7'</label>	
      <label><input class="height-filter" name="pan_height[]" value="h96" type="checkbox" id="h96" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h96', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>8'</label>
      <label><input class="height-filter" name="pan_height[]" value="h108" type="checkbox" id="h108" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h108', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>9'</label>
      <label><input class="height-filter" name="pan_height[]" value="h120" type="checkbox" id="h120" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h120', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>10'</label>
      <label><input class="height-filter" name="pan_height[]" value="h132" type="checkbox" id="h132" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h132', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>11'</label>
      <label><input class="height-filter" name="pan_height[]" value="h144" type="checkbox" id="h144" <?php if(!empty($_POST)) { if(isset($panHeight) && (in_array('h144', $panHeight))) { echo 'checked'; } } else { echo 'checked'; } ?>>12' and taller</label>
    </div>
  </div>
  <h3 class="bh-catalog-filter-heading"><div class="container">Width</div></h3>
  <div class="catalog-filters width-filters">
    <div class="container">
      <label><input type="checkbox" id="wu36" class="width-filter" name="pan_width[]" value="wu36" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu36', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>less than 36"</label>
      <label><input type="checkbox" id="wu42" class="width-filter" name="pan_width[]" value="wu42" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu42', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>36" - 41"</label>
      <label><input type="checkbox" id="wu48" class="width-filter" name="pan_width[]" value="wu48" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu48', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>42" - 47"</label>
      <label><input type="checkbox" id="wu60" class="width-filter" name="pan_width[]" value="wu60" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu60', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>48" to 59"</label>
      <label><input type="checkbox" id="wu72" class="width-filter" name="pan_width[]" value="wu72" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wu72', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>60" to 72"</label>
      <label><input type="checkbox" id="wo72" class="width-filter" name="pan_width[]" value="wo72" <?php if(!empty($_POST)) { if(isset($panWidth) && (in_array('wo72', $panWidth))) { echo 'checked'; } } else { echo 'checked'; } ?>>72" or more</label>
    </div>
  </div>
  <h3 class="bh-catalog-filter-heading"><div class="container">Grade</div></h3>
  <div class="catalog-filters pan-grade-filter">
    <div class="container">
      <label><input type="checkbox" id="premium" class="pan-grade" name="pan_grade[]" value="premium" <?php if(!empty($_POST)) { if(isset($panGrade) && (in_array('premium', $panGrade))) { echo 'checked'; }  } else { echo 'checked'; } ?>>Premium <span>(greater than 7/8" thickness)</span></label>
      <label><input type="checkbox" id="standard" class="pan-grade" name="pan_grade[]" value="standard" <?php if(!empty($_POST)) { if(isset($panGrade) && (in_array('standard', $panGrade))) { echo 'checked'; }  } else { echo 'checked'; } ?>>Standard <span>(1/2" to 7/8" thickness)</span></label>
      <label><input type="checkbox" id="interior" class="pan-grade" name="pan_grade[]" value="interior" <?php if(!empty($_POST)) { if(isset($panGrade) && (in_array('interior', $panGrade))) { echo 'checked'; }  } else { echo 'checked'; } ?>>Interior <span>(less than 1/2" thickness)</span></label>
    </div>
  </div>
  
</form>