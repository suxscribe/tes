import Swiper from 'swiper';
import _ from 'lodash';
import PhotoSwipe from 'photoswipe';
import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default.js';
import Component from '../../common/js/component';
import { DEBOUNCE_INTERVAL_MS, SCREEN_MD_MIN_PX } from '../../common/js/variables';
import {
  calculateColWidth, getDeviceType, listen,
  nFindComponent, Resize, unlisten,
} from '../../common/js/helpers';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';

class Gallery extends Component {
  constructor(nRoot) {
    super(nRoot, 'gallery');
    this.currentDevice = getDeviceType();
    this.afterResize = this.afterResize.bind(this);

    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.swipers = this.nFind('swiper-container').map((nSwiperContainer, i) => {
      nSwiperContainer.querySelector('.swiper-wrapper').style.left = `-${i * 100}%`;
      return new Swiper(nSwiperContainer, {
        loop: true,
        loopedSlides: 6,
        slidesPerView: '1',
        grabCursor: true,
        clickable: true, //zrx photoswipe
        allowTouchMove: true,
        on: {
          touchStart: () => {
            this.bindAllSlidersTo(i);
          },
        },
        pagination: {
          el: this.mobileSliderNavigation.nFind('progress'),
          type: 'progressbar',
        },
        /*keyboard: {
                enabled: true,
        }*/
      });
    });
    this.moveNext = this.moveNext.bind(this);
    this.movePrev = this.movePrev.bind(this);
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop();
    }
    this.updateSlidersWidth();
    this.updateSlidersWidth = _.debounce(this.updateSlidersWidth.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.updateSlidersWidth);
    // this.swipers[1].on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.swipers[1].realIndex + 1));

    this.resize = new Resize();
    listen('deviceType:after-resize', this.afterResize);




    // 2 of 2 : PHOTOSWIPE #######################################

    // initPhotoSwipeFromDOM(gallerySelector) {
      // parse slide data (url, title, size ...) from DOM elements
      // (children of gallerySelector)
      var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
          numNodes = thumbElements.length,
          items = [],
          figureEl,
          linkEl,
          size,
          item;

        for (var i = 0; i < numNodes; i++) {
          figureEl = thumbElements[i]; // <figure> element

          // include only element nodes
          if (figureEl.nodeType !== 1) {
            continue;
          }

          linkEl = figureEl.children[1].children[0]; // <a> element
          // console.log(linkEl);

          if (linkEl) {
            size = linkEl.getAttribute("data-size").split("x");
          } else {
            size = [1200,600]; //zrx todo
          }

          // create slide object
          item = {
            src: linkEl.getAttribute("href"),
            w: parseInt(size[0], 10),
            h: parseInt(size[1], 10)
          };


          if (figureEl.children.length > 1) {
            // <figcaption> content
            // item.title = figureEl.children[1].innerHTML;
            item.title = 'Image';
          }


          if (linkEl.children.length > 0) {
            // <img> thumbnail element, retrieving thumbnail url
            item.msrc = linkEl.children[0].getAttribute("src");
          }
          // console.log('item');
          // console.log(item);

          item.el = figureEl; // save link to element for getThumbBoundsFn
          items.push(item);
        }

        return items;
      };

      // find nearest parent element
      var closest = function closest(el, fn) {
        return el && (fn(el) ? el : closest(el.parentNode, fn));
      };

      // triggers when user clicks on thumbnail
      var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : (e.returnValue = false);

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
          return el.tagName && el.classList.contains('swiper-slide');
        });

        if (!clickedListItem) {
          return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
          childNodes = clickedListItem.parentNode.childNodes,
          numChildNodes = childNodes.length,
          nodeIndex = 0,
          index;

        for (var i = 0; i < numChildNodes; i++) {
          if (childNodes[i].nodeType !== 1) {
            continue;
          }

          if (childNodes[i] === clickedListItem) {
            index = nodeIndex;
            break;
          }
          nodeIndex++;
        }

        if (index >= 0) {
          // open PhotoSwipe if valid index found
          openPhotoSwipe(index, clickedGallery);
        }
        return false;
      };

      var openPhotoSwipe = function(index,galleryElement,disableAnimation,fromURL) {
        var pswpElement = document.querySelectorAll(".pswp")[0],
          gallery,
          options,
          items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)

        options = {

          // Buttons/elements
          closeEl: true,
          captionEl: false,
          fullscreenEl: false,
          zoomEl: false,
          shareEl: false,
          counterEl: false,
          arrowEl: true,
          preloaderEl: true,
          timeToIdle: null,
          history:false,
          allowUserZoom: false,
          arrowKeys: false,
          /* "showHideOpacity" uncomment this If dimensions of your small thumbnail don't match dimensions of large image */
          showHideOpacity:true, //fade animation
          // define gallery index (for URL)
          galleryUID: galleryElement.getAttribute("data-pswp-uid"),

        };

        options.index = parseInt(index, 10);


        // exit if index not found
        if (isNaN(options.index)) {
          return;
        }

        if (disableAnimation) {
          options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();

        /* EXTRA CODE (NOT FROM THE CORE) - UPDATE SWIPER POSITION TO THE CURRENT ZOOM_IN IMAGE (BETTER UI) */

        // photoswipe event: Gallery unbinds events
        // (triggers before closing animation)
        gallery.listen("unbindEvents", function() {
          // This is index of current photoswipe slide
          var getCurrentIndex = gallery.getCurrentIndex();

          //document.querySelector('.pswp__button--arrow--right').removeEventListener('click', this.moveNext);
          //document.querySelector('.pswp__button--arrow--left').removeEventListener('click', this.movePrev);

          // Update position of the slider
          // console.log(document.querySelector('.swiper-container').swiper);

/*          const swipers = document.querySelectorAll('.swiper-container');
          let swipeObj = [];
          swipers.forEach(item => {
            item.swiper.slideTo(getCurrentIndex, false);
            item.swiper.slideTo(item.swiper.realIndex, false);

            // item.swiper.loopDestroy();
            // item.swiper.loopCreate();

          });*/

          // swipeObj.forEach(swiper => swiper.update());
          // document.querySelectorAll('.swiper-container').forEach(item => item.swiper.slideTo(getCurrentIndex, false));

        });

        var oldIndex = 0;



        gallery.listen('beforeChange', function() {
          var getCurrentIndex = gallery.getCurrentIndex();
          var lastIndex = gallery.options.getNumItemsFn() - 1;
          var isDragging = gallery.isDragging();
          console.log(getCurrentIndex);
          console.log('total' + lastIndex);
          console.log(isDragging); //mouse click only. click button - true

          //TODO if not click and not keypress - swipe this
          //how to detect keypress here?



          if (!isDragging ) {
            if (getCurrentIndex == 0 && oldIndex == lastIndex) {
              console.log('right');
            } else if (getCurrentIndex == lastIndex && oldIndex == 0) {
              console.log('left');
            } else if (getCurrentIndex > oldIndex && getCurrentIndex != 0) {
              console.log('right');
            } else {
              console.log('left');
            }
          }


          oldIndex = getCurrentIndex;
          // const swipers = document.querySelectorAll('.swiper-container');
          // swipers[0].swiper.slideTo(getCurrentIndex, false);
        });


        gallery.listen('afterChange', function() {
          var getCurrentIndex = gallery.getCurrentIndex();
          console.log(getCurrentIndex);


          // console.log(gallery.isDragging());
          // console.log(getCurrentIndex-1);

          //buggy when it loops
          /*const swipers = document.querySelectorAll('.swiper-container');
          swipers.forEach(item => {
            if (getCurrentIndex-1 < 0) getCurrentIndex = 1;
            item.swiper.slideTo(getCurrentIndex-1, false);
            item.swiper.slideTo(item.swiper.realIndex, false);

            // item.swiper.loopDestroy();
            // item.swiper.loopCreate();

          });*/

          /*const swipers = document.querySelectorAll('.swiper-container');
            swipers.forEach(item => {
              item.swiper.slideNext();
              swipers[0].swiper.slideNext();
              //todo при клике назад делать slideprev
          });*/

        });

      };

      // loop through all gallery elements and bind events
      var galleryElements = document.querySelectorAll(".gallery__swiper-container");

      for (var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute("data-pswp-uid", i + 1);
        galleryElements[i].onclick = onThumbnailsClick;
      }

    // }



    // execute above function
    // this.initPhotoSwipeFromDOM(".gallery__swiper-container");

  // END PHOTOSWIPE ==================================================




  }

  initDesktop() {
    this.swipers.forEach((swiper) => { swiper.params.pagination.progressbarOpposite = true; });
    document.querySelector('.pswp__button--arrow--right').addEventListener('click', this.moveNext);
    document.querySelector('.pswp__button--arrow--left').addEventListener('click', this.movePrev);

    document.onkeydown = checkKey;
    function checkKey(e) {

        e = e || window.event;

        if (e.keyCode == '38') {
            // up arrow
        }
        else if (e.keyCode == '40') {
            // down arrow
        }
        else if (e.keyCode == '37') {
           // this.movePrev;
           console.log('moveprev');
           document.querySelector('.pswp__button--arrow--left').click();
        }
        else if (e.keyCode == '39') {
           // this.moveNext;
           console.log('movenext');
           document.querySelector('.pswp__button--arrow--right').click();
        }
    }
    var isKey = false;

    document.addEventListener("keydown", function onEvent(event) {
        if (event.keyCode == '37') {
          isKey = true;
        }
        else if (event.keyCode == '39') {
          isKey = true;
        }
        console.log('isKey' + isKey);
    });


  }

  initMobile() {
    this.swipers.forEach((swiper) => { swiper.params.pagination.progressbarOpposite = false; });
    this.mobileSliderNavigation.nFindSingle('next').addEventListener('click', this.moveNext);
    this.mobileSliderNavigation.nFindSingle('prev').addEventListener('click', this.movePrev);
  }





  bindAllSlidersTo(i) {
    this.swipers.forEach(swiper => swiper.controller.control = null);
    const swipersToControl = this.swipers.concat();
    swipersToControl.splice(i, 1);
    this.swipers[i].controller.control = swipersToControl;
  }

  moveNext() {
    this.bindAllSlidersTo(0);
    this.swipers[0].slideNext();
  }

  movePrev() {
    this.bindAllSlidersTo(0);
    this.swipers[0].slidePrev();
  }

  updateSlidersWidth() {
    this.swipers.forEach((swiper) => {
      let widthPx;
      if (matchMedia(`(min-width: ${SCREEN_MD_MIN_PX}px)`).matches) {
        widthPx = `${Math.round(calculateColWidth() * 4)}px`;
      } else {
        widthPx = `${Math.round(calculateColWidth() * 6.5)}px`;
      }
      if (!swiper.$el) {
        return;
      }
      swiper.$el[0].style.width = widthPx;
      [...swiper.$el[0]
        .querySelectorAll('.swiper-slide')]
        .forEach(nSlide => nSlide.style.width = widthPx);
      swiper.update();
    });
  }

  afterResize() {
    if (getDeviceType() !== this.currentDevice) {
      if (getDeviceType() === 'mobile') {
        this.initMobile();
      } else {
        this.initDesktop();
        this.mobileSliderNavigation.nFindSingle('next').removeEventListener('click', this.moveNext);
        this.mobileSliderNavigation.nFindSingle('prev').removeEventListener('click', this.movePrev);
      }
      this.currentDevice = getDeviceType();
    }
  }

  destroy() {
    this.resize.destroy();
    unlisten('deviceType:after-resize', this.afterResize);
    this.swipers.forEach(swiper => swiper.destroy());
    this.mobileSliderNavigation.destroy();
    if (getDeviceType() === 'mobile') {
      this.mobileSliderNavigation.nFindSingle('next').removeEventListener('click', this.moveNext);
      this.mobileSliderNavigation.nFindSingle('prev').removeEventListener('click', this.movePrev);
    }

    document.querySelector('.pswp__button--arrow--right').removeEventListener('click', this.moveNext);
    document.querySelector('.pswp__button--arrow--left').removeEventListener('click', this.movePrev);
  }
}

export default Gallery;
