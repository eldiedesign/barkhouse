import 'magnific-popup';

export default {
  init() {

    $('ul.the-product-gallery').each(function() {
      $(this).children('li').children('a.gallery-popup').magnificPopup({
        type: 'image',
        gallery: {
          enabled: true,
          tCounter: '',
        },
        image: {
          titleSrc: function (item) {
            var cap = item.el.attr('data-caption');
            return cap;
          },
          verticalFit: true,
        },
      });
    })

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};