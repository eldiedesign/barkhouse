export default {
  init() {
    // JavaScript to be fired on the home page
    
    const addons = document.querySelectorAll('.wc-pao-addon-container'),
          attrToggles = document.querySelectorAll('.ihmm-toggle-container'),
          productEl = document.querySelector('div.product'),
          productTabs = document.querySelectorAll('.product-tab'),
          totalSqft = document.querySelector('input#total-sqft'),
          orderPanel = document.querySelector('a#quote-form-btn');
    var orderPanelUrl,
        itemName;


    console.log(sessionStorage);
    
    if(orderPanel) {
      orderPanel.addEventListener('click', function(e) {
        e.preventDefault();
        var finalAmount = false,
            itemDetails = '';
        if(document.querySelector('body').classList.contains('cat_panels')) {
          finalAmount = document.querySelector('li.wc-pao-subtotal-line span.amount') ? document.querySelector('li.wc-pao-subtotal-line span.amount').textContent : false;
        }
        if(document.querySelector('body').classList.contains('cat_live-edge-slabs')) {
          finalAmount = document.querySelector('span.woocommerce-Price-amount.amount') ? document.querySelector('span.woocommerce-Price-amount.amount').textContent : false;
        }
        orderPanelUrl = orderPanel.getAttribute('href');
        var addOnItems = document.querySelectorAll('.product-addon-totals .wc-pao-col1');
        if(addOnItems.length) { // panels only
          var n = 0;
          addOnItems.forEach(function(item) {
            console.log(item.textContent);
            if(n == 0) {
              itemName = item.textContent.replace('1x ', 'bh_panel');
            } else {
              var addonName = item.textContent.replace('- ', ' ');
              //orderPanelUrl += addonName;
              itemDetails += addonName;
            }
            n++;
          })
        } 
        if(document.querySelector('body').classList.contains('cat_live-edge-slabs')) { // slabs - no addon details
          itemName = 'bh_slab '+document.querySelector('.title-wrap h1').textContent;
          console.log(itemName);
          
        }

        if(finalAmount) {
          //orderPanelUrl += ' '+finalAmount.replace(',', '');
          itemDetails += ' '+finalAmount.replace(',', '');
          sessionStorage.setItem(itemName, itemDetails);
          console.log(sessionStorage);
          for (var i = 0; i < sessionStorage.length; i++) {
           
            var key = sessionStorage.key(i),
                value = sessionStorage.getItem(sessionStorage.key(i));
            if(key.includes('bh_panel')) {
              console.log(key + ' ' + value);
              orderPanelUrl += key.replace('bh_panel ', '')+' '+value+',';
            }
            if(key.includes('bh_slab')) {
              console.log(key + ' ' + value);
              orderPanelUrl += key.replace('bh_slab ', '')+' '+value+',';
            }
          }
          console.log(orderPanelUrl);
          orderPanelUrl = orderPanelUrl.slice(-1) == ',' ? orderPanelUrl.slice(0, -1) : orderPanelUrl;
          window.location.href = orderPanelUrl;
        }
      });
    }

    if (!productEl.classList.contains('product_cat-live-edge-slabs')) {
      $('.woocommerce-product-gallery a').magnificPopup({
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
    }
    
    if(productTabs) {
      productTabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
          setTimeout(function() {
            window.dispatchEvent(new Event('resize'));
          }, 20);
          
        });
      })
    }

    /* function formatNumber(n) {
      n = n.toString();
      return n.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    } */

    ///const initPrice = document.querySelector('#product-addons-total').dataset.rawPrice,
          //variationInputs = document.querySelectorAll('span.variable-item-span-button'),
    const addonInputs = document.querySelectorAll('select.wc-pao-addon-field option, input.wc-pao-addon-field');
          /* if (variationInputs) {
            priceUpdate(variationInputs);
          } */
          if (addonInputs) {
            priceUpdate(addonInputs);
          }


    function priceUpdate(inputs) {

      if(totalSqft) {
        console.log(totalSqft);

        inputs.forEach(function(input) {

         // var totalAddonAmount = 0;
          const pricePerSqft = input.getAttribute('data-raw-price'),
                addonAmount = pricePerSqft*totalSqft.value;
             //   label = input.dataset.label;
          input.setAttribute('data-raw-price', addonAmount);
          input.setAttribute('data-price', addonAmount);

      /*    input.addEventListener('change', function(e) { // add dropdown support here
            e.preventDefault()
            var totalAddonAmount = 0;
            var pricePerSqft = input.getAttribute('data-raw-price'),
                label = input.dataset.label;
            setTimeout(function() {
              console.log(pricePerSqft);
     
              var addOnTotals = document.querySelectorAll('.product-addon-totals ul li');
              if(addOnTotals) {

                addOnTotals.forEach(function(adt) {
                  var totalsLabel = adt.querySelector('.wc-pao-col1'),
                      totalsPrice = adt.querySelector('.wc-pao-col2');
                  if(totalsLabel && totalsPrice) {
                    if(totalsLabel.textContent.includes(label)) {
                      console.log(totalSqft);
                      console.log(pricePerSqft);
                      console.log(pricePerSqft*totalSqft.value);
                      var addonAmount = pricePerSqft*totalSqft.value;
                      totalsPrice.textContent = `$${formatNumber(addonAmount)}`;
                      totalAddonAmount += addonAmount;
                    }
                  }
                  if(adt.classList.contains('wc-pao-subtotal-line')) {
                    var displayAmount = formatNumber(parseFloat(initPrice)+parseFloat(totalAddonAmount));
                    adt.querySelector('span.amount').textContent = `$${displayAmount}`;
                  }
                })
              }
            }, 10)
          }) */


        })
      }
    }

    function runTheToggles(attrToggles) {
      attrToggles.forEach(function (attrWrap) {
        console.log(attrWrap);
        var toggle = attrWrap.querySelector('.ihmm-attribute-toggle'),
          content = attrWrap.querySelector('.ihmm-attribute-content');
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
          
          /* setTimeout(function() {
            $(window).trigger('resize').trigger('scroll');
          }, 200) */
        })
      })
    }
    if(addons) {
     
      const cartForm = document.querySelector('form.cart'),
            addonDescriptions = document.querySelectorAll('.ihmm-desc');
      var simpleForm = false;
      if(cartForm && !cartForm.classList.contains('variations_form')) {
        simpleForm = true;
      }
      addons.forEach(function(addon) {
        var heading = addon.querySelector('.wc-pao-addon-name');
        addon.classList.add('ihmm-toggle-container');
        if(heading) {
          var attrHeading = document.createElement('h2');
          attrHeading.classList.add('ihmm-attribute-toggle');
          attrHeading.innerHTML = heading.textContent;
          var addonContent = addon.innerHTML,
              attrContent = document.createElement('div'),
              attrInner = document.createElement('div');
          if(simpleForm && addonDescriptions) {
            addonDescriptions.forEach(function(desc) {
              var att = desc.dataset.attribute,
                  head = heading.textContent;
                  head = head.replace(/[^\w!?]/g, '');
                  console.log('|'+head+'|'+att+'|');
              if (att == head) {
                addonContent += desc.innerHTML;
              }
            })
          }
          
          attrContent.classList.add('inner');
          attrInner.classList.add('ihmm-attribute-content');
            addon.innerHTML = '';
            attrContent.innerHTML = addonContent;
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
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
