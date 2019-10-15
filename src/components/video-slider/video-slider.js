
import Swiper from 'swiper';
import _ from 'lodash';
import Component from '../../common/js/component';
import { DEBOUNCE_INTERVAL_MS, SCREEN_MD_MIN_PX } from '../../common/js/variables';
import {
  calculateColWidth, getDeviceType, listen,
  nFindComponent, nFindComponents, Resize, unlisten,
} from '../../common/js/helpers';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';
import Video from '../video/video';

class VideoSlider extends Component {
  constructor(nRoot) {
    super(nRoot, 'video-slider');
    this.currentDevice = getDeviceType();
    this.afterResize = this.afterResize.bind(this);
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.swipers = this.nFind('swiper-container').map((nSwiperContainer, i) => {
      nSwiperContainer.querySelector('.swiper-wrapper').style.left = `-${i * 100}%`;
      return new Swiper(nSwiperContainer, {
        loop: true,
        grabCursor: true,
        slidesPerView: 'auto',
        keyboard: false,
        allowTouchMove: true,
        observer: true,
        observeParents: true,
        observeSlideChildren: true,
        on: {
          touchStart: () => {
            this.bindAllSlidersTo(i);
          },
          init: () => {
            if (i === 1) {
              this.setVideoId(i);
            }
          },
        },
        pagination: {
          el: this.mobileSliderNavigation.nFind('progress'),
          type: 'progressbar',
        },
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
    this.swipers[1].on('slideChange', () => {
      this.videoItems.map(nVideo => nVideo.pause());
      this.mobileSliderNavigation.setCurrent(this.swipers[1].realIndex + 1);
    });
    this.resize = new Resize();
    listen('deviceType:after-resize', this.afterResize);
    window.swipers = this.swipers;
  }

  initDesktop() {
    this.swipers.forEach((swiper) => { swiper.params.pagination.progressbarOpposite = true; swiper.slideReset(); });
  }

  initMobile() {
    this.swipers.forEach((swiper) => { swiper.params.pagination.progressbarOpposite = false; swiper.slideReset(); });
    this.mobileSliderNavigation.nFindSingle('next').addEventListener('click', this.moveNext);
    this.mobileSliderNavigation.nFindSingle('prev').addEventListener('click', this.movePrev);
  }

  setVideoId(i) {
    setTimeout(() => {
      let index = 0;
      this.videoItems = nFindComponents('video', this.swipers[1].el).map(nVideo => new Video(nVideo));
      this.videoItems.map((nVideo) => {
        let videoYT = nVideo.nRoot.querySelector('.video__item_youtube');
        if (videoYT) {
          videoYT.setAttribute('id', `youtube-${index}`);
          index += 1;
        }
      });
    }, 1000);
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
        widthPx = `${Math.round(calculateColWidth() * 6)}px`;
      } else {
        widthPx = `${Math.round(calculateColWidth() * 8.07)}px`;
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
    this.mobileSliderNavigation.destroy();
    this.swipers.forEach(swiper => swiper.destroy());
    if (getDeviceType() === 'mobile') {
      this.mobileSliderNavigation.nFindSingle('next').removeEventListener('click', this.moveNext);
      this.mobileSliderNavigation.nFindSingle('prev').removeEventListener('click', this.movePrev);
    }
  }
}

export default VideoSlider;
