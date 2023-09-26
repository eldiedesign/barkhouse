import 'magnific-popup';

export default {
  init() {
    
    // make slabs & panels same height
    const infos = document.querySelectorAll('.meta-wrap');
    function metaHeights() {
      if(infos) {
        document.documentElement.style.setProperty('--meta-height', 'auto');
        var infoHeights = [];
        infos.forEach(function (info) {
          infoHeights.push(info.clientHeight);
        })
        var max = infoHeights.reduce(function (a, b) {
          return Math.max(a, b);
        }, 0);
        console.log(max);
        
        document.documentElement.style.setProperty('--meta-height', max + 'px');
      }
    }

    function doGallery() {
      $('.show-size.show-cat.show-tree a.image-link, .show-height.show-width.show-grade a.image-link').magnificPopup({
        type: 'image',
        gallery: {
          enabled: true,
          tCounter: '',
        },
        image: {
          titleSrc: function (item) {
            var cap = item.el.attr('data-title');
            return cap;
          },
          verticalFit: true,
        },
      });
    }

    const sortingForm = document.querySelector('form.sorting-form'),
          sortingInputs = sortingForm.querySelectorAll('input');
    
    if (sortingInputs) {
      sortingInputs.forEach(function(input) {
        input.addEventListener('change', function() {
          setTimeout(function() {
            doGallery();
          }, 200)
        });
      })
    }
    
    window.addEventListener('load', function() {
      metaHeights();
      doGallery();
    })
    
    window.addEventListener('resize', function() {
      setTimeout(function() {
        metaHeights();
      }, 80);
      
    });

    


  /*   
    function dragStart(e) {
      console.log(e);
      
      e.dataTransfer.setData('text/plain', e.target.id);
      setTimeout(() => {
        e.target.classList.add('hide');
      }, 0);

    }
    function dragEnter(e) {
      e.preventDefault();
      
      
      e.target.classList.add('drag-over');
    }

    function dragOver(e) {
      e.preventDefault();
      e.target.classList.add('drag-over');
    } */

   /*  function dragLeave(e) {
      e.target.classList.remove('drag-over');
    } */
/*     function drag(e) {
      console.log(e);
      e.target.style.position = 'absolute';
      e.target.style.left = e.clientX+(e.pageX - e.clientX)+'px';
      e.target.style.top = e.clientY+(e.pageY - e.clientY)+'px';
      
    } */
    /* function dragEnd(e) {
      e.target.classList.remove('drag-over');
      e.target.classList.remove('hide');
    } */
/* 
    function drop(e) {
      e.target.classList.remove('drag-over');

      // get the draggable element
      const id = e.dataTransfer.getData('text/plain');
      const draggable = document.getElementById(id);
      var srcParent = draggable.parentNode;
      var tgt = e.currentTarget.firstElementChild;
      // add it to the drop target
      e.currentTarget.replaceChild(draggable, tgt);
      srcParent.appendChild(tgt);
     // e.target.appendChild(draggable);

      // display the draggable element
      draggable.classList.remove('hide');
    }
 */




   /*  if ($('#list-view').children('input[type=radio]').is(':checked')) {
      $('.panel').addClass('list-view');
      $(this).addClass('active');
      $('#grid-view').removeClass('active');
    } */
    const gridView = document.querySelector('#grid-view'),
          listView = document.querySelector('#list-view'),
          theGrid = document.querySelector('.slab-grid');
    if(gridView && listView && theGrid) {
      gridView.addEventListener('click', function() {
        gridView.classList.add('active');
        listView.classList.remove('active');
        theGrid.classList.remove('list-view');
      });
      listView.addEventListener('click', function() {
        listView.classList.add('active');
        gridView.classList.remove('active');
        theGrid.classList.add('list-view');
      });
    }
   /*  $('#grid-view').click(function () {
      $('.panel').removeClass('list-view');
      $(this).addClass('active');
      $('#list-view').removeClass('active');
    });
    $('#list-view').click(function () {
      $('.panel').addClass('list-view');
      $(this).addClass('active');
      $('#grid-view').removeClass('active');
    }); */

    const panelGrid = document.querySelector('#panel-grid');

    if(panelGrid) {
      const compareChecks = document.querySelectorAll('input.compare-check'),
        compareBtn = document.querySelector('#compare-selected');
      if (compareChecks) {
        compareChecks.forEach(function (check) {
          check.addEventListener('click', function () {
            document.querySelector('#compare-btn-wrap').style.display = 'block';
            setTimeout(() => {
              document.querySelector('#compare-btn-wrap').style.opacity = '1';
            }, 10);
            var slab = check.closest('.slab');
            slab.classList.contains('selected') ? slab.classList.remove('selected') : slab.classList.add('selected');
          });
        });
        compareBtn.addEventListener('click', function () {
          const selectedSlabs = document.querySelectorAll('.slab.selected'),
            compareModalWrap = document.querySelector('#compare-modal-wrap'),
            compareModal = compareModalWrap.querySelector('.inner'),
            closeModal = compareModalWrap.querySelector('#close-compare');
          var innerWidth = 0,
            n = 0;
          selectedSlabs.forEach(function (slab) {
            console.log(slab);
            n++;
            var slabImg = slab.querySelector('img').outerHTML,
              slabWidth = slab.querySelector('img').dataset.scalewidth,
              slabHeight = slab.querySelector('img').dataset.scaleheight,
              slabTitle = slab.querySelector('h3').outerHTML,
              compareSlab = document.createElement('div'),
              compareInner = document.createElement('div'),
              rotate = document.createElement('button');
            innerWidth += (parseInt(slabWidth) + 10);
            compareSlab.classList.add('compare-slab');
            compareInner.classList.add('compare-inner');
            rotate.classList.add('rotate-slab');
            rotate.textContent = 'rotate 90°';
            compareInner.innerHTML += slabImg;
            compareInner.innerHTML += slabTitle;
            compareInner.appendChild(rotate);
            compareSlab.appendChild(compareInner);
            compareSlab.setAttribute('data-rotation', '0');
            /* compareSlab.addEventListener('dragenter', dragEnter)
            compareSlab.addEventListener('dragover', dragOver);
            compareSlab.addEventListener('dragleave', dragLeave);
            compareSlab.addEventListener('drop', drop); */
            //compareSlab.addEventListener('dragend', drag);
            /* compareSlab.addEventListener('dragend', dragEnd); */
            compareModal.appendChild(compareSlab);
            rotate.addEventListener('click', function (e) {
              e.preventDefault();
              compareSlab.style.transform = 'rotate(' + (parseInt(compareSlab.dataset.rotation) + 90) + 'deg)';
              compareSlab.setAttribute('data-rotation', parseInt(compareSlab.dataset.rotation) + 90);
            })
            $('.compare-slab').on('mousedown', function (e) {
              if (!e.target.classList.contains('rotate-slab')) {
                $(this).addClass('active');
                var oTop = e.pageY - $('.compare-slab.active').offset().top;
                var oLeft = e.pageX - $('.compare-slab.active').offset().left;
                $(this).parents().on('mousemove', function (e) {
                  $('.active').offset({
                    top: e.pageY - oTop,
                    left: e.pageX - oLeft,
                  }).on('mouseup', function () {
                    $(this).removeClass('active');
                  });
                });
              }
              return false;
            });

            compareInner.setAttribute('draggable', true);
            compareInner.setAttribute('id', 'draggable-' + n);
            //compareInner.addEventListener('dragstart', dragStart);
            compareInner.querySelector('img').setAttribute('width', slabWidth);
            compareInner.querySelector('img').setAttribute('height', slabHeight);
            compareInner.querySelector('img').style.width = slabWidth + 'px';
            compareInner.querySelector('img').style.height = slabHeight + 'px';
          });
          //var emptyBox = document.createElement('div');
          compareModalWrap.className = '';
          compareModalWrap.classList.add('count-' + selectedSlabs.length);
          compareModal.style.width = (innerWidth + 210) + 'px';
          compareModalWrap.style.display = 'block';
          closeModal.addEventListener('click', function () {
            compareModalWrap.style.display = 'none';
            compareModal.innerHTML = '';

          });
        });
      }

      $('.height-filter').change(function () {
        if ($('#h72').is(':checked')) {
          $('.h72').addClass('show-height');
        } else {
          $('.h72').removeClass('show-height');
        }
        if ($('#h84').is(':checked')) {
          $('.h84').addClass('show-height');
        } else {
          $('.h84').removeClass('show-height');
        }
        if ($('#h144').is(':checked')) {
          $('.h144').addClass('show-height');
        } else {
          $('.h144').removeClass('show-height');
        }
        if ($('#h96').is(':checked')) {
          $('.h96').addClass('show-height');
        } else {
          $('.h96').removeClass('show-height');
        }
        if ($('#h108').is(':checked')) {
          $('.h108').addClass('show-height');
        } else {
          $('.h108').removeClass('show-height');
        }
        if ($('#h120').is(':checked')) {
          $('.h120').addClass('show-height');
        } else {
          $('.h120').removeClass('show-height');
        }
        if ($('#h132').is(':checked')) {
          $('.h132').addClass('show-height');
        } else {
          $('.h132').removeClass('show-height');
        }
        if ($('#h144').is(':checked')) {
          $('.h144').addClass('show-height');
        } else {
          $('.h144').removeClass('show-height');
        }
        //doGallery();
      });

      $('.width-filter').change(function () {
        if ($('#wu36').is(':checked')) {
          $('.wu36').addClass('show-width');
        } else {
          $('.wu36').removeClass('show-width');
        }
        if ($('#wu42').is(':checked')) {
          $('.wu42').addClass('show-width');
        } else {
          $('.wu42').removeClass('show-width');
        }
        if ($('#wu48').is(':checked')) {
          $('.wu48').addClass('show-width');
        } else {
          $('.wu48').removeClass('show-width');
        }
        if ($('#wu60').is(':checked')) {
          $('.wu60').addClass('show-width');
        } else {
          $('.wu60').removeClass('show-width');
        }
        if ($('#wu72').is(':checked')) {
          $('.wu72').addClass('show-width');
        } else {
          $('.wu72').removeClass('show-width');
        }
        if ($('#wo72').is(':checked')) {
          $('.wo72').addClass('show-width');
        } else {
          $('.wo72').removeClass('show-width');
        }
        //doGallery();
      });

      $('.pan-grade').change(function () {
        if ($('#premium').is(':checked')) {
          $('.premium').addClass('show-grade');
        } else {
          $('.premium').removeClass('show-grade');
        }
        if ($('#standard').is(':checked')) {
          $('.standard').addClass('show-grade');
        } else {
          $('.standard').removeClass('show-grade');
        }
        if ($('#interior').is(':checked')) {
          $('.interior').addClass('show-grade');
        } else {
          $('.interior').removeClass('show-grade');
        }
        //doGallery();
      });

      //same thing on doc ready...
      if ($('#premium').is(':checked')) {
        console.log('premium');
        $('.premium').addClass('show-grade');
      } else {
        $('.premium').removeClass('show-grade');
      }
      if ($('#standard').is(':checked')) {
        $('.standard').addClass('show-grade');
      } else {
        $('.standard').removeClass('show-grade');
      }
      if ($('#interior').is(':checked')) {
        $('.interior').addClass('show-grade');
      } else {
        $('.interior').removeClass('show-grade');
      }
      if ($('#wu36').is(':checked')) {
        $('.wu36').addClass('show-width');
      } else {
        $('.wu36').removeClass('show-width');
      }
      if ($('#wu42').is(':checked')) {
        $('.wu42').addClass('show-width');
      } else {
        $('.wu42').removeClass('show-width');
      }
      if ($('#wu48').is(':checked')) {
        $('.wu48').addClass('show-width');
      } else {
        $('.wu48').removeClass('show-width');
      }
      if ($('#wu60').is(':checked')) {
        $('.wu60').addClass('show-width');
      } else {
        $('.wu60').removeClass('show-width');
      }
      if ($('#wu72').is(':checked')) {
        $('.wu72').addClass('show-width');
      } else {
        $('.wu72').removeClass('show-width');
      }
      if ($('#wo72').is(':checked')) {
        $('.wo72').addClass('show-width');
      } else {
        $('.wo72').removeClass('show-width');
      }
      if ($('#h72').is(':checked')) {
        $('.h72').addClass('show-height');
      } else {
        $('.h72').removeClass('show-height');
      }
      if ($('#h84').is(':checked')) {
        $('.h84').addClass('show-height');
      } else {
        $('.h84').removeClass('show-height');
      }
      if ($('#h96').is(':checked')) {
        $('.h96').addClass('show-height');
      } else {
        $('.h96').removeClass('show-height');
      }
      if ($('#h108').is(':checked')) {
        $('.h108').addClass('show-height');
      } else {
        $('.h108').removeClass('show-height');
      }
      if ($('#h120').is(':checked')) {
        $('.h120').addClass('show-height');
      } else {
        $('.h120').removeClass('show-height');
      }
      if ($('#h132').is(':checked')) {
        $('.h132').addClass('show-height');
      } else {
        $('.h132').removeClass('show-height');
      }
      if ($('#h144').is(':checked')) {
        $('.h144').addClass('show-height');
      } else {
        $('.h144').removeClass('show-height');
      }
    } else { // live edge slabs



      if ($('#listv').children('input[type=radio]').is(':checked')) {
        $('.les-slab').addClass('list-view');
        $(this).addClass('active');
        $('#gridv').removeClass('active');
      }

      $('#gridv').click(function () {
        $('.les-slab').removeClass('list-view');
        $(this).addClass('active');
        $('#listv').removeClass('active');
      });

      $('#listv').click(function () {
        $('.les-slab').addClass('list-view');
        $(this).addClass('active');
        $('#gridv').removeClass('active');
      });

      $('.les-cats').change(function () {
        if ($('#cat-rectangular').is(':checked')) {
          $('.rectangular').addClass('show-cat');
        } else {
          $('.rectangular').removeClass('show-cat');
        }
        if ($('#cat-irregular').is(':checked')) {
          $('.irregular').addClass('show-cat');
        } else {
          $('.irregular').removeClass('show-cat');
        }
        if ($('#cat-mantle').is(':checked')) {
          $('.mantle').addClass('show-cat');
        } else {
          $('.mantle').removeClass('show-cat');
        }
        if ($('#cat-round').is(':checked')) {
          $('.round').addClass('show-cat');
        } else {
          $('.round').removeClass('show-cat');
        }
        //doGallery();
      });

      $('.les-size').change(function () {
        if ($('#u72').is(':checked')) {
          $('.u72').addClass('show-size');
        } else {
          $('.u72').removeClass('show-size');
        }
        if ($('#u95').is(':checked')) {
          $('.u95').addClass('show-size');
        } else {
          $('.u95').removeClass('show-size');
        }
        if ($('#u119').is(':checked')) {
          $('.u119').addClass('show-size');
        } else {
          $('.u119').removeClass('show-size');
        }
        if ($('#o120').is(':checked')) {
          $('.o120').addClass('show-size');
        } else {
          $('.o120').removeClass('show-size');
        }
        //doGallery();
      });

      $('.les-tree').change(function () {
        if ($('#ash').is(':checked')) {
          $('.ash').addClass('show-tree');
        } else {
          $('.ash').removeClass('show-tree');
        }
        if ($('#cherry').is(':checked')) {
          $('.cherry').addClass('show-tree');
        } else {
          $('.cherry').removeClass('show-tree');
        }
        if ($('#cedar').is(':checked')) {
          $('.cedar').addClass('show-tree');
        } else {
          $('.cedar').removeClass('show-tree');
        }
        if ($('#hard-maple').is(':checked')) {
          $('.hard-maple').addClass('show-tree');
        } else {
          $('.hard-maple').removeClass('show-tree');
        }
        if ($('#hickory').is(':checked')) {
          $('.hickory').addClass('show-tree');
        } else {
          $('.hickory').removeClass('show-tree');
        }
        if ($('#locust').is(':checked')) {
          $('.locust').addClass('show-tree');
        } else {
          $('.locust').removeClass('show-tree');
        }
        if ($('#soft-maple').is(':checked')) {
          $('.soft-maple').addClass('show-tree');
        } else {
          $('.soft-maple').removeClass('show-tree');
        }
        if ($('#oak').is(':checked')) {
          $('.oak').addClass('show-tree');
        } else {
          $('.oak').removeClass('show-tree');
        }
        if ($('#gum').is(':checked')) {
          $('.gum').addClass('show-tree');
        } else {
          $('.gum').removeClass('show-tree');
        }
        if ($('#walnut').is(':checked')) {
          $('.walnut').addClass('show-tree');
        } else {
          $('.walnut').removeClass('show-tree');
        }
        if ($('#birch').is(':checked')) {
          $('.birch').addClass('show-tree');
        } else {
          $('.birch').removeClass('show-tree');
        }
        if ($('#white-oak').is(':checked')) {
          $('.white-oak').addClass('show-tree');
        } else {
          $('.white-oak').removeClass('show-tree');
        }
        if ($('#pine').is(':checked')) {
          $('.pine').addClass('show-tree');
        } else {
          $('.pine').removeClass('show-tree');
        }
        if ($('#other').is(':checked')) {
          $('.other').addClass('show-tree');
        } else {
          $('.other').removeClass('show-tree');
        }
        //doGallery();
      });

      if ($('#cat-rectangular').is(':checked')) {
        $('.rectangular').addClass('show-cat');
      } else {
        $('.rectangular').removeClass('show-cat');
      }
      if ($('#cat-irregular').is(':checked')) {
        $('.irregular').addClass('show-cat');
      } else {
        $('.irregular').removeClass('show-cat');
      }
      if ($('#cat-mantle').is(':checked')) {
        $('.mantle').addClass('show-cat');
      } else {
        $('.mantle').removeClass('show-cat');
      }
      if ($('#cat-round').is(':checked')) {
        $('.round').addClass('show-cat');
      } else {
        $('.round').removeClass('show-cat');
      }
      if ($('#u72').is(':checked')) {
        $('.u72').addClass('show-size');
      } else {
        $('.u72').removeClass('show-size');
      }
      if ($('#u95').is(':checked')) {
        $('.u95').addClass('show-size');
      } else {
        $('.u95').removeClass('show-size');
      }
      if ($('#u119').is(':checked')) {
        $('.u119').addClass('show-size');
      } else {
        $('.u119').removeClass('show-size');
      }
      if ($('#o120').is(':checked')) {
        $('.o120').addClass('show-size');
      } else {
        $('.o120').removeClass('show-size');
      }
      if ($('#ash').is(':checked')) {
        $('.ash').addClass('show-tree');
      } else {
        $('.ash').removeClass('show-tree');
      }
      if ($('#cherry').is(':checked')) {
        $('.cherry').addClass('show-tree');
      } else {
        $('.cherry').removeClass('show-tree');
      }
      if ($('#cedar').is(':checked')) {
        $('.cedar').addClass('show-tree');
      } else {
        $('.cedar').removeClass('show-tree');
      }
      if ($('#hard-maple').is(':checked')) {
        $('.hard-maple').addClass('show-tree');
      } else {
        $('.hard-maple').removeClass('show-tree');
      }
      if ($('#hickory').is(':checked')) {
        $('.hickory').addClass('show-tree');
      } else {
        $('.hickory').removeClass('show-tree');
      }
      if ($('#locust').is(':checked')) {
        $('.locust').addClass('show-tree');
      } else {
        $('.locust').removeClass('show-tree');
      }
      if ($('#soft-maple').is(':checked')) {
        $('.soft-maple').addClass('show-tree');
      } else {
        $('.soft-maple').removeClass('show-tree');
      }
      if ($('#oak').is(':checked')) {
        $('.oak').addClass('show-tree');
      } else {
        $('.oak').removeClass('show-tree');
      }
      if ($('#gum').is(':checked')) {
        $('.gum').addClass('show-tree');
      } else {
        $('.gum').removeClass('show-tree');
      }
      if ($('#walnut').is(':checked')) {
        $('.walnut').addClass('show-tree');
      } else {
        $('.walnut').removeClass('show-tree');
      }
      if ($('#birch').is(':checked')) {
        $('.birch').addClass('show-tree');
      } else {
        $('.birch').removeClass('show-tree');
      }
      if ($('#white-oak').is(':checked')) {
        $('.white-oak').addClass('show-tree');
      } else {
        $('.white-oak').removeClass('show-tree');
      }
      if ($('#pine').is(':checked')) {
        $('.pine').addClass('show-tree');
      } else {
        $('.pine').removeClass('show-tree');
      }
      if ($('#other').is(':checked')) {
        $('.other').addClass('show-tree');
      } else {
        $('.other').removeClass('show-tree');
      }


    }


  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};