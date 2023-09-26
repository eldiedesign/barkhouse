export default {
  init() {
    // JavaScript to be fired on the home page
    const slider = document.querySelector('#home-slider'),
    sliderDelay = 6000;
    var isMobile = document.querySelector('body').classList.contains('is-mobile') ? true : false,
      isPaused = false,
      lastSlideLoaded = false;

    console.log(isMobile);
    console.log(lastSlideLoaded);
    

    function changeSlide(dir) {
      var slides = document.querySelectorAll('#home-slider .slide'),
        currentSlide = document.querySelector('#home-slider .slide.open'),
        currentSlideNum = currentSlide.dataset.slide,
        totalSlides = slides.length,
        nextSlide = currentSlideNum == totalSlides ? 1 : parseInt(currentSlideNum) + 1,
        prevSlide = currentSlideNum == 1 ? totalSlides : parseInt(currentSlideNum) - 1,
        toLoad = currentSlideNum < (totalSlides-1) ? parseInt(currentSlideNum)+2 : false;

      if(toLoad) {
        var slideToLoad = document.querySelector('#home-slider .slide-' + toLoad);
        if (!slideToLoad.classList.contains('loaded')) {
          var thisSlide = slideToLoad.querySelector('.the-image'),
              imgUrl = thisSlide.dataset.image;
          thisSlide.style.background = `url(${imgUrl}) no-repeat`;
        }

      }
      currentSlide.classList.remove('open');
      if (dir == 'prev') {
        document.querySelector('#home-slider .slide-' + prevSlide).classList.add('open');
        
        if (currentSlideNum == 2 && !document.querySelector('#home-slider .slide-' + totalSlides).classList.contains('loaded')) {
          document.querySelector('.slider-prev').classList.add('hidden');
          lastSlideLoaded = false;
        }
      } else {
        document.querySelector('#home-slider .slide-' + nextSlide).classList.add('open');
        document.querySelector('.slider-prev').classList.remove('hidden');
        lastSlideLoaded = true;
      }
    }

    if(slider) {
      const next = slider.querySelector('button.slider-next'),
            prev = slider.querySelector('button.slider-prev');
      if(next && prev) {
        next.addEventListener('click', function() {
          changeSlide('next');
          clearInterval(interval);
          interval = setInterval(sliderIntervalFunction, sliderDelay);
        });
        prev.addEventListener('click', function() {
          changeSlide('prev');
          clearInterval(interval);
          interval = setInterval(sliderIntervalFunction, sliderDelay);
        });
      }
     /*  sliderWrap.addEventListener('mouseover', function () {
        isPaused = true;
      });
      sliderWrap.addEventListener('mouseout', function () {
        isPaused = false;
      }); */

    /*   if(isMobile) {
        document.addEventListener('touchstart', handleTouchStart, false);
        document.addEventListener('touchmove', handleTouchMove, false);
        var xDown = null;
        var yDown = null;
      } */

    }

    function sliderIntervalFunction() {
        if (!isPaused) {
          changeSlide('next');
        }
        if (thingDone) {
          clearInterval(interval);
        }
    }

    var thingDone = false,
        interval = setInterval( sliderIntervalFunction, sliderDelay);

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
