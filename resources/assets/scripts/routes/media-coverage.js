// make slabs & panels same height
/* const infos = document.querySelectorAll('.meta-wrap');
function metaHeights() {
  if (infos) {
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
window.addEventListener('load', function () {
  metaHeights();
})

window.addEventListener('resize', function () {
  setTimeout(function () {
    metaHeights();
  }, 80);
}); */

$('.iframe-popup').magnificPopup({
  type: 'iframe',
  mainClass: 'mfp-fade',
  removalDelay: 160,
  preloader: false,
});
$('.img-popup').magnificPopup({
  type: 'image',
 /*  gallery: {
    enabled: true,
    tCounter: '',
  }, */
  image: {
    titleSrc: function (item) {
      var cap = item.el.attr('data-caption');
      return cap;
    },
    verticalFit: true,
  },
});