export default {
  init() {

    // since the easiest (?) way to remove one panel from the list of panels which make up the one 'panels' param was to remove the whole param and update the current url, when we arrive and there's no 'panels' param, we check for panels in sessionStorage and, if panels found, rebuild the param and refresh the page with that param
    var panelsParam = '',
        hasPanelInSession = false,
        formUrl = window.location.href;
    if(!formUrl.includes('panels')) {
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
    if(!formUrl.includes('slabs')) {
      for (var slabIndex = 0; slabIndex < sessionStorage.length; slabIndex++) {
        var slabKey = sessionStorage.slabKey(slabIndex),
            slabValue = sessionStorage.getItem(sessionStorage.slabKey(slabIndex));
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
          console.log('opoo');
          
          for (var i = 0; i < sessionStorage.length; i++) {
            var key = sessionStorage.key(i);
            if(key.includes('bh_panel')) {
              console.log(key);
              if(btn.closest('.gfield_list_group').querySelector('input').value.includes(key.replace('bh_panel ', ''))) {
                sessionStorage.removeItem(key);
              }
            }
            console.log(key);
            
            if(key.includes('bh_slab')) {
              console.log(key+ 'poop');
              if(btn.closest('.gfield_list_group').querySelector('input').value.includes(key.replace('bh_slab ', ''))) {
                sessionStorage.removeItem(key);
              }
            }
          }
          const url = new URL(window.location.href)
          const params = new URLSearchParams(url.search.slice(1))
          params.delete('panels')
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
