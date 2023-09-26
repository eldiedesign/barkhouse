export default {
  init() {

    const years = document.querySelectorAll('a.miles-pager'),
          stones = document.querySelectorAll('.milestone'),
          stonesWrap = document.querySelector('.the-milestones'),
          slider = document.querySelector('#milestone-slider'),
          timeline = document.querySelector('#timeline');
    if(years && stones) {
      years.forEach(function(year) {
        year.addEventListener('click', function() {
          var theYear = year.dataset.year,
              activeYear = timeline.querySelector('.miles-pager.active');
          stones.forEach(function(stone) {
            if (stone.dataset.year == theYear) {
              var stoneY = stone.offsetTop,
                  yearY = year.offsetTop,
                  slide = year.dataset.slideIndex;
              if(slide == 0) {
                document.querySelector('#leaf').classList.add('top');
                timeline.style.top = '0px';
              } else {
                document.querySelector('#leaf').classList.remove('top');
                timeline.style.top = '-' + (yearY - 75) + 'px';
              }
              slider.style.top = '-'+stoneY+'px';
              stonesWrap.style.maxHeight = stone.clientHeight+'px';
              activeYear.classList.remove('active');
              year.classList.add('active');
            }
          })
        });
      })
    }

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};