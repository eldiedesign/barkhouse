import 'magnific-popup';

export default {
  init() {
    // JavaScript to be fired on all pages
console.log(document.location.search);

    const body = document.querySelector('body'),
      //alertBar = body.querySelector('#alert-bar'),
      header = body.querySelector('header.banner'),
      pageHeader = body.querySelector('.page-header'),
      faqs = body.querySelectorAll('.schema-faq-section'),
      menuParents = body.querySelectorAll('.menu-item-has-children'),
      searchToggle = body.querySelector('#search-toggle'),
      menuToggle = body.querySelector('#menu-toggle'),
      mobileMenu = body.querySelector('header.banner'),
      modalCloseSearch = body.querySelector('#search-close'),
      categoryFilter = body.querySelector('#cat-filter'),
      galleries = body.querySelectorAll('.blocks-gallery-grid'),
      accordionToggles = body.querySelectorAll('.ihmm-accordion-wrap');

    var didScroll = false,
      winTop = window.pageYOffset;
      //lastWinTop = 0,
      //goingDown = true,
      //alertHeight;
    
    $('.content').fitVids();
    if(body.classList.contains('template-videos')) {
      $('.video-link').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
      });
      if(window.location.hash) {
        body.querySelector(window.location.hash).click();
        
      }
    }

    function runTheToggles(toggles) {
      toggles.forEach(function (toggleWrap) {
        //console.log(toggleWrap);
        var toggle = toggleWrap.querySelector('.ihmm-accordion-toggle'),
          content = toggleWrap.querySelector('.ihmm-accordion-content');
        toggle.addEventListener('click', function () {
          var contentHeight = content.querySelector('.inner').clientHeight;
          if (toggle.classList.contains('open')) {
            toggle.classList.remove('open');
            content.classList.remove('open');
            content.style.height = '0px';
          } else {
            toggle.classList.add('open');
            content.classList.add('open');
            content.style.height = contentHeight + 'px';
          }
          setTimeout(() => {
            window.dispatchEvent(new Event('resize'));
          }, 500);
        })
      })
    }

    if(accordionToggles) {
      runTheToggles(accordionToggles);
    }

    if (menuParents) {
      menuParents.forEach(function (parent) {
        const subMenu = parent.querySelector('.sub-menu'),
              trigger = parent.children[0];
        //console.log(parent.children[0]);
        trigger.addEventListener('click', function (e) {
          e.preventDefault();
          menuParents.forEach(function (otherparent) {
            if (otherparent.classList.contains('open') && otherparent !== parent) {
              otherparent.classList.toggle('open');
              otherparent.querySelector('.sub-menu').style.height = '0px';
            }
          });
          if (!parent.classList.contains('open')) {
            subMenu.classList.add('open');
            parent.classList.add('open');
            const subItems = subMenu.querySelectorAll('li');
            if(subItems) {
              var subHeight = 0;
              subItems.forEach(function(item) {
                subHeight += parseInt(item.clientHeight);
              })
              subMenu.style.height = subHeight+'px';
            }
           /*  var newDiv;
            if (!parent.classList.contains('submenu-created')) {
              const theSubMenu = subMenu.innerHTML;
              newDiv = document.createElement('div');
              newDiv.classList.add('submenu-wrap');
              var menuWidth = parent.clientWidth + 15;
              newDiv.innerHTML = `<div class="back"><button class="back-menu">${subMenuHeading}</button></div><ul class="sub" style="min-width:${menuWidth}px">${theSubMenu}</ul>`;
              parent.appendChild(newDiv);
              var backMenu = newDiv.querySelector('.back-menu');
              if(backMenu) {
                backMenu.addEventListener('click', function() {
                  parent.classList.remove('open')
                });
              }
              parent.classList.add('submenu-created');
            } else {
              newDiv = parent.querySelector('.submenu-wrap');
            }
            setTimeout(() => {
              var theHeight = newDiv.querySelector('ul').clientHeight;
              parent.classList.toggle('open');
              newDiv.style.height = `${theHeight}px`;
            }, 200); */
          } else {
            parent.classList.toggle('open');
            subMenu.classList.remove('open');
            subMenu.style.height = '0px';
          }
        });
      });
    }

    /* function closeDropdowns(both) {
      const dropDowns = body.querySelectorAll('.submenu-wrap');
      if (dropDowns) {
        dropDowns.forEach(function (dropDown) {
          dropDown.style.height = '0px';
          dropDown.parentNode.classList.remove('open');
        });
      }
      if (both) {
        if (searchForm) {
          searchForm.classList.remove('open');
        }
      }
    } */


    if (menuToggle) {
      menuToggle.addEventListener('click', function () {
        if (this.classList.contains('is-active')) {
          this.classList.remove('is-active');
          mobileMenu.classList.remove('menu-open');
          body.classList.remove('mobile-menu-open');
          setTimeout(function () {
            mobileMenu.style.display = 'none';
          }, 700);
        } else {
          mobileMenu.style.display = 'block';
          this.classList.add('is-active');
          setTimeout(function () {
            mobileMenu.classList.add('menu-open');
            body.classList.add('mobile-menu-open');
          }, 10);
        }
      });
    }

    if(categoryFilter) {
      categoryFilter.addEventListener('change', function() {
        var theLink = this.value;
        window.location.href = theLink;
        return false;
      });
    }

    if (searchToggle) {
      searchToggle.addEventListener('click', openModalSearch);
      modalCloseSearch.addEventListener('click', closeModalSearch);
    }

    function openModalSearch() {
     
    }

    function closeModalSearch() {
     
    }

    if (faqs) {
      faqs.forEach(function (faq) {
        const toggle = faq.querySelector('.schema-faq-question'),
          content = faq.querySelector('.schema-faq-answer');
        toggle.addEventListener('click', function () {
          if (!this.classList.contains('open')) {
            const theContent = content.innerHTML;
            content.innerHTML = content.classList.contains('opened') ? theContent : `<div class="the-content">${theContent}</div>`;
            content.classList.add('opened');
            setTimeout(() => {
              var theHeight = content.querySelector('.the-content').clientHeight;
              toggle.classList.toggle('open');
              content.style.height = `${theHeight}px`;
            }, 20);
          } else {
            toggle.classList.toggle('open');
            content.style.height = '0px';
          }
        });
      });
    }

    if (header) {
      window.addEventListener('scroll', function () {
        winTop = window.pageYOffset;
       /*  if (alertBar) {
          alertHeight = alertBar.clientHeight;
          //(winTop > 58) ? body.classList.add('alert-scrolled') : body.classList.remove('alert-scrolled');
          if (winTop > alertHeight) {
            body.classList.add('alert-scrolled');
            header.classList.remove('absolute');
          } else {
            body.classList.remove('alert-scrolled');
            header.classList.add('absolute');
          }

        }
 */
        var headerTop = pageHeader && pageHeader.clientHeight > 130 ? pageHeader.clientHeight-160 : 70;
        //console.log(pageHeader.clientHeight);
        
        if (winTop > headerTop) {
          body.classList.add('scrolt');
          /* if (goingDown) {
            closeDropdowns(true);
          } */

        } else {
          //header.classList.remove('transition');
          body.classList.remove('scrolt');
        }

/*         if (winTop > lastWinTop) { // scolling down
          //  if(winTop < 500) {
          header.classList.remove('dropped');
          if (!goingDown) {
            setTimeout(() => {
              header.classList.remove('transition');
            }, 400);
          }
          goingDown = true;
          //   }
        } else { // scrolling up
          if (winTop > 300) {
            header.classList.add('dropped');
            header.classList.add('transition');
          }
          goingDown = false;
        }
        lastWinTop = winTop; */
        didScroll = true;
      });
    }

    setInterval(function () {
      if (didScroll) {
        didScroll = false;
      }
    }, 200);

    window.addEventListener('load', function () {

      const slider = document.querySelector('.test-slider');
      if (slider) {
        const slides = slider.querySelectorAll('.slide');
        var sn = 0;
        var heights = [];
        var dots = document.createElement('div');
        dots.classList.add('dots');
        slider.appendChild(dots);
        slides.forEach(function (slide) {
          var dot = document.createElement('button');
          dot.classList.add('dot');
          dot.setAttribute('data-slide', sn);
          dot.innerHTML = 'show slide '+sn;
          if (sn == 0) {
            dot.classList.add('active');
          }
          dots.appendChild(dot);
          heights.push(slide.querySelector('blockquote').clientHeight);
          if (sn == 0) {
            slide.classList.add('active');
          }
          slide.classList.add('slide-' + sn);
          slide.setAttribute('data-slide-no', sn);
          sn++;
        });
        var sliderHeight = Math.max(...heights);
        slider.style.height = (sliderHeight + 75) + 'px';
        dots.querySelectorAll('.dot').forEach(function(dot) {
          dot.addEventListener('click', function () {
            var activeSlide = slider.querySelector('.active'),
                activeDot = dots.querySelector('.active'),
                gotoNo = dot.dataset.slide,
                gotoSlide = slider.querySelector('[data-slide-no="' + gotoNo + '"]');
            activeSlide.classList.remove('active');
            activeDot.classList.remove('active');
            gotoSlide.classList.add('active');
            dot.classList.add('active');
          });
        });
      }

      function popupGalleries() {
        $('.wp-block-gallery').each(function () {
          $(this).children('ul').children('li').children('figure').children('a').magnificPopup({
            type: 'image',
            gallery: {
              enabled: !0,
              tCounter: '',
            },
            image: {
              titleSrc: function (item) {
                var cap = item.el.parent('figure').children('figcaption').text();
                return cap
              },
              verticalFit: !0,
            },
          });
        })
      }

      if (galleries) {
        popupGalleries();
      }

    });

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

