export default {
  init() {

  },
  finalize() {
    var slug = document.querySelector('#pageslug'),
        paramsToPass = {};

    const shingleHeights = document.querySelectorAll('.gfield.shingle-height input[type=radio]'),
          shingleArea = document.querySelector('.gfield.surface_area input[type=number]');
    //slug = slug ? slug.value : false;
    function roundArea(sqft, inc) {
      return Math.ceil(sqft / inc) * inc;
    }

    function numRound() {
      console.log(paramsToPass);
      
      if(paramsToPass.height != null) {
        var inc = 1;
        if(paramsToPass.height == '13') {
          inc = 4;
        }
        if(paramsToPass.height == '18') {
          inc = 6;
        }
        if(paramsToPass.height == '26') {
          inc = 8;
        }
        shingleArea.value = roundArea(shingleArea.value, inc);
      }
      paramsToPass['surface_area'] = shingleArea.value;
      console.log(shingleArea.value);
    }

    if(slug.value == 'order-poplar-bark-shingle-siding') {

      if(shingleHeights && shingleArea) {
        shingleHeights.forEach(function(rad) {
          console.log(rad);
          if(rad.checked) {
            paramsToPass['height'] = rad.value;
          }
          rad.addEventListener('click', function() {
            paramsToPass['height'] = rad.value;
            console.log(rad.value);
          });
        })
        if(shingleArea.value != 0) {
          numRound();
        }
        shingleArea.addEventListener('change', numRound);
      }
    }
   /*  if(slug.value == 'order-poplar-bark-subway-panels') {
      
    } */





    // since the easiest (?) way to remove one panel from the list of panels which make up the one 'panels' param was to remove the whole param and update the current url, when we arrive and there's no 'panels' param, we check for panels in sessionStorage and, if panels found, rebuild the param and refresh the page with that param
    var panelsParam = '',
    hasPanelInSession = false,
    formUrl = window.location.href;
if(formUrl.includes('poplar-bark-panel') && !formUrl.includes('panels=')) {
  for (var i = 0; i < sessionStorage.length; i++) {
    var key = sessionStorage.key(i),
        value = sessionStorage.getItem(sessionStorage.key(i));
    if(key.includes('bh_panel')) {
      console.log(key);
      hasPanelInSession = true;
      panelsParam += key.replace('bh_panel ', '')+value+',';
    }
  }
  if(hasPanelInSession) {
    panelsParam = panelsParam.slice(-1) == ',' ? panelsParam.slice(0, -1) : panelsParam;
    if(formUrl.includes('?')) {
      window.location.href = formUrl+encodeURI('&panels='+panelsParam);
    } else {
      window.location.href = formUrl+encodeURI('?panels='+panelsParam);
    }
  }
}
if(formUrl.includes('live-edge-slabs') && !formUrl.includes('slabs=')) {
  for (var slabIndex = 0; slabIndex < sessionStorage.length; slabIndex++) {
    var slabKey = sessionStorage.key(slabIndex),
        slabValue = sessionStorage.getItem(sessionStorage.key(slabIndex));
    if(slabKey.includes('bh_slab')) {
      console.log(slabKey);
      hasPanelInSession = true;
      panelsParam += slabKey.replace('bh_slab ', '')+slabValue+',';
    }
  }
  if(hasPanelInSession) {
    panelsParam = panelsParam.slice(-1) == ',' ? panelsParam.slice(0, -1) : panelsParam;
    if(formUrl.includes('?')) {
      window.location.href = formUrl+encodeURI('&slabs='+panelsParam);
    } else {
      window.location.href = formUrl+encodeURI('?slabs='+panelsParam);
    }
  }
}

// if a panel is removed form the form, also remove it from sessionStorage
const deleteItems = document.querySelectorAll('button.delete_list_item');
if(deleteItems) {
  deleteItems.forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      for (var i = 0; i < sessionStorage.length; i++) {
        var key = sessionStorage.key(i);
        if(key.includes('bh_panel')) {
          console.log(key);
          if(btn.closest('.gfield_list_group').querySelector('input').value.includes(key.replace('bh_panel ', ''))) {
            sessionStorage.removeItem(key);
          }
        }
        
        if(key.includes('bh_slab')) {
          if(btn.closest('.gfield_list_group').querySelector('input').value.includes(key.replace('bh_slab ', ''))) {
            sessionStorage.removeItem(key);
          }
        }
      }
      console.log(sessionStorage);
      const url = new URL(window.location.href)
      const params = new URLSearchParams(url.search.slice(1))
      params.delete('panels');
      params.delete('slabs');
      window.history.replaceState(
        {},
        '',
        `${window.location.pathname}?${params}${window.location.hash}`
      )
    });
  })
 }

  },
};