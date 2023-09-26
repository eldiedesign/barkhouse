export default {
  init() {
    // JavaScript to be fired on the home page

  },
  finalize() {
    
    // HAY!!  - do not work on pages locally. Set up the product pages on the dev site then pull db to local to avoid version conflicts with editors

    const addons = document.querySelectorAll('.wc-pao-addon-container'),
          attrToggles = document.querySelectorAll('.ihmm-toggle-container'),
          productTabs = document.querySelectorAll('.product-tab'),
          formOptions = document.querySelectorAll('.option-description');

    function roundArea(sqft, inc) {
      return Math.ceil(sqft / inc) * inc;
    }

    if(formOptions) {
      var paramsToPass = {};
      
      const requestBtns = document.querySelectorAll('a.request-product'),
            slug = document.querySelector('input#slug') ? document.querySelector('input#slug').value : false; 
      formOptions.forEach(function(opt) {
        const radios = opt.querySelectorAll('input[type=radio]'),
              dropdowns = opt.querySelectorAll('select'),
              numberInputs = opt.querySelectorAll('input[type=number]'),
              textInputs = opt.querySelectorAll('input[type=text]');
        if(radios.length > 0) {
          radios.forEach(function(rad) {
            if(rad.checked) {
              paramsToPass[rad.getAttribute('name')] = rad.value;
            }
            rad.addEventListener('click', function() {
              paramsToPass[rad.getAttribute('name')] = rad.value;
            });
          })
        }
        if(dropdowns.length > 0) {
          console.log('has dropdowns');
        }
        if(numberInputs.length > 0) {
          numberInputs.forEach(function(num) {
            function numRound() {
              if((slug == 'poplar-bark-shingle-siding'|| slug == 'poplar-bark-interior-wall-tiles') && paramsToPass.height != null) {
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
                num.value = roundArea(num.value, inc);
              }
              paramsToPass[num.getAttribute('name')] = num.value;
              console.log(paramsToPass);
            }
            if(num.value != 0) {
              numRound();
            }
            num.addEventListener('change', numRound);
          })
        }
        if(textInputs.length > 0) {
          textInputs.forEach(function(textInput) {
            textInput.addEventListener('change', function() {
              paramsToPass[textInput.getAttribute('name')] = textInput.value;
              console.log(paramsToPass);
            });
          })
        }
      });
      console.log(window.location);
      if(requestBtns) {
        requestBtns.forEach(function(btn) {
          btn.addEventListener('click', function(e) {
          
            e.preventDefault();
            var formUrl = btn.getAttribute('href');
            
            formUrl = (!formUrl.includes('http:') && !formUrl.includes('https:')) ? window.location.protocol+formUrl : formUrl;
            //console.log(formUrl);
            
            formUrl = new URL(formUrl);
            for (var key in paramsToPass) {
              var value = paramsToPass[key];
              formUrl.searchParams.append(key , value);
            }
            window.location.href = formUrl;
          
          });
        })
        
       
      }

      
    }

    $('a.img-link').magnificPopup({
      type: 'image',
      gallery: {
        enabled: !0,
        tCounter: '',
      },
      image: {
        titleSrc: function (item) {
          console.log(item.el);
          
          var cap = item.el[0].dataset.caption;
          return cap
        },
        verticalFit: !0,
      },
    });

    if(productTabs) {
      var t = 1;
      productTabs.forEach(function(tab) {
        if(t == 1) {
          tab.classList.add('active');
        }

        tab.addEventListener('click', function(e) {
          e.preventDefault();
          document.querySelector('.woocommerce-Tabs-panel.active').classList.remove('active');
          document.querySelector('.product-tab.active').classList.remove('active');
          tab.classList.add('active');
          const activePanel = tab.dataset.tab;
          //console.log(activePanel);
          
          document.querySelector(activePanel).classList.add('active');

          setTimeout(function() {
            window.dispatchEvent(new Event('resize'));
          }, 20);
          
        });
        t++;
      })
    }

    function priceUpdate(inputs) {
      inputs.forEach(function(input) {
        input.addEventListener('click', function() {
          setTimeout(function() {
            var addonTotal = document.querySelector('#product-addons-total');
            //console.log(addonTotal);
            if (addonTotal.querySelector('li.wc-pao-subtotal-line span.amount')) {
              var subTotal = addonTotal.querySelector('li.wc-pao-subtotal-line span.amount').textContent;
              const wcPriceWrap = document.querySelector('p.price span.price-wrap');
              if (wcPriceWrap) {
                wcPriceWrap.textContent = 'Price: ' + subTotal;
              }
            }
          }, 500)
          
        })
      })
    }

   /*  window.addEventListener('load', function() {
      
    }) */
    

    function runTheToggles(attrToggles) {
      attrToggles.forEach(function (attrWrap) {
        //console.log(attrWrap);
        
        
        var toggle = attrWrap.querySelector('.ihmm-attribute-toggle'),
          content = attrWrap.querySelector('.ihmm-attribute-content');
        toggle.addEventListener('click', function () {
          /* if(attrWrap.classList.contains('order-product-option')) {
            attrWrap.parentNode.querySelectorAll('li.order-product-option').forEach(function(optLi) {
              if(attrWrap == optLi) {
                return;
              }
              var optToggle = optLi.querySelector('.ihmm-attribute-toggle'),
                  optContent = optLi.querySelector('.ihmm-attribute-content');
              if (optToggle.classList.contains('open')) {
                optToggle.classList.remove('open');
                optContent.classList.remove('open');
                optContent.style.height = '0px';
              }
            });
          } */

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

          var variationInputs = document.querySelectorAll('span.variable-item-span-button'),
              addonInputs = document.querySelectorAll('input.wc-pao-addon-field');
          if (variationInputs) {
            priceUpdate(variationInputs);
          }
          if (addonInputs) {
            priceUpdate(addonInputs);
          }
        })
      })
    }

    if(addons) {
      addons.forEach(function(addon) {
        var heading = addon.querySelector('h2.wc-pao-addon-name');
        addon.classList.add('ihmm-toggle-container');
        if(heading) {
          var attrHeading = document.createElement('h2');
          attrHeading.classList.add('ihmm-attribute-toggle');
          attrHeading.innerHTML = heading.textContent;
          heading.remove();
          var addonContent = addon.innerHTML,
              attrContent = document.createElement('div'),
              attrInner = document.createElement('div');
          attrContent.classList.add('inner');
          attrInner.classList.add('ihmm-attribute-content');
          attrContent.innerHTML = addonContent;
          addon.innerHTML = '';
          addon.prepend(attrHeading);
          attrInner.append(attrContent);
          addon.append(attrInner);
        }
      })
      runTheToggles(addons);
      
    }

    if(attrToggles) {
      runTheToggles(attrToggles);
    }
  },
};
