import Component from '../../common/js/component';
import Swiper from 'swiper';
import _ from 'lodash';
import {
  DEBOUNCE_INTERVAL_MS,
  SCREEN_XL_MIN_PX,
} from '../../common/js/variables';
import {
  calculateColWidth,
  getDeviceType,
  listen,
  nFindComponent,
  Resize, unlisten
} from '../../common/js/helpers';
import SliderNavigation from '../slider-navigation/slider-navigation';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';

class Projects extends Component {
  constructor(nRoot) {
    super(nRoot, 'projects');
    this.afterResize = this.afterResize.bind(this);
    this.currentDevice = getDeviceType();
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop();
    }
    this.resize = new Resize();
    listen('deviceType:after-resize', this.afterResize);
  }

  initDesktop() {
    this.projectsNavigation = new SliderNavigation(
      nFindComponent('slider-navigation_projects'),
      this.nRoot,
    );
    this.swipers = this.nFind('swiper-container').map((nSwiperContainer, i) => {
      nSwiperContainer.querySelector('.swiper-wrapper').style.left = `-${i * 100}%`;
      return new Swiper(nSwiperContainer, {
        loop: true,
        slidesPerView: 'auto',
        keyboard: {
          enabled: true,
          onlyInViewport: true,
        },
        on: {
          touchStart: () => {
            this.bindAllSlidersTo(i);
          },
        },
      });
    });
    this.bindAllSlidersTo(this.swipers.length - 1);
    this.moveNext = this.moveNext.bind(this);
    this.projectsNavigation.nFindSingle('arrow_next').addEventListener('click', this.moveNext);
    this.movePrev = this.movePrev.bind(this);
    this.projectsNavigation.nFindSingle('arrow_prev').addEventListener('click', this.movePrev);
    this.updateSlidersWidth();
    this.updateSlidersWidth = _.debounce(this.updateSlidersWidth.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.updateSlidersWidth);
  }

  initMobile() {
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    const nMobileSlider = this.nFindSingle('swiper-container');
    nMobileSlider.querySelectorAll('.swiper-slide:nth-child(2n)').forEach(nSlide => {
      nSlide.style.display = 'none';
    });
    this.mobileSwiper = new Swiper(nMobileSlider, {
      pagination: {
        el: this.mobileSliderNavigation.nFindSingle('progress'),
        type: 'progressbar',
      },
      navigation: {
        prevEl: this.mobileSliderNavigation.nFindSingle('prev'),
        nextEl: this.mobileSliderNavigation.nFindSingle('next'),
      },
    });
    this.mobileSwiper.on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.mobileSwiper.realIndex + 1));
  }

  bindAllSlidersTo(i) {
    this.swipers.forEach(swiper => {
      swiper.controller.control = null;
      swiper.keyboard.disable();
    });
    const swipersToControl = this.swipers.concat();
    swipersToControl.splice(i, 1);
    this.swipers[i].controller.control = swipersToControl;
    this.swipers[i].keyboard.enable();
  }

  moveNext() {
    this.bindAllSlidersTo(this.swipers.length - 1);
    this.swipers[this.swipers.length - 1].slideNext();
  }

  movePrev() {
    this.bindAllSlidersTo(this.swipers.length - 1);
    this.swipers[this.swipers.length - 1].slidePrev();
  }

  updateSlidersWidth() {
    if (this.swipers.length !== 4) {
      this.nFindSingle('sliders-wrapper').style.width =
        `${calculateColWidth() * (7.75 - (4 - this.swipers.length) * 2)}px`;
    }
    this.swipers.forEach((swiper, i) => {
      let widthPx;
      if (matchMedia(`(min-width: ${SCREEN_XL_MIN_PX}px)`).matches) {
        widthPx = `${Math.round(calculateColWidth() * 1.75)}px`;
      } else {
        widthPx = `${Math.round(calculateColWidth() * 7.25 / 2)}px`;
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
        this.projectsNavigation.destroy();
        this.projectsNavigation.nFindSingle('arrow_next').removeEventListener('click', this.moveNext);
        this.projectsNavigation.nFindSingle('arrow_prev').removeEventListener('click', this.movePrev);
        this.swipers.forEach(swiper => swiper.destroy());
        window.removeEventListener('resize', this.updateSlidersWidth);
        this.initMobile();
      } else {
        this.mobileSwiper.destroy();
        this.mobileSliderNavigation.destroy();
        this.initDesktop();
      }
      this.currentDevice = getDeviceType();
    }
  }

  destroy() {
    if (getDeviceType() !== this.currentDevice) {
      if (this.currentDevice === 'mobile') {
        this.mobileSwiper.destroy();
        this.mobileSliderNavigation.destroy();
        const nMobileSlider = this.nFindSingle('swiper-container');
        nMobileSlider.querySelectorAll('.swiper-slide:nth-child(2n)').forEach(nSlide => {
          nSlide.style.removeProperty('display');
        });
      } else {
        this.projectsNavigation.destroy();
        this.projectsNavigation.nFindSingle('arrow_next').removeEventListener('click', this.moveNext);
        this.projectsNavigation.nFindSingle('arrow_prev').removeEventListener('click', this.movePrev);
        this.swipers.forEach(swiper => swiper.destroy());
        window.removeEventListener('resize', this.updateSlidersWidth);
      }
    } else if (getDeviceType() === 'mobile') {
      const nMobileSlider = this.nFindSingle('swiper-container');
      nMobileSlider.querySelectorAll('.swiper-slide:nth-child(2n)').forEach(nSlide => {
        nSlide.style.removeProperty('display');
      });
      this.mobileSwiper.destroy();
      this.mobileSliderNavigation.destroy();
    } else {
      this.projectsNavigation.destroy();
      this.projectsNavigation.nFindSingle('arrow_next').removeEventListener('click', this.moveNext);
      this.projectsNavigation.nFindSingle('arrow_prev').removeEventListener('click', this.movePrev);
      this.swipers.forEach(swiper => swiper.destroy());
      window.removeEventListener('resize', this.updateSlidersWidth);

    }
    unlisten('deviceType:after-resize', this.afterResize);
    this.resize.destroy();
  }
}

export default Projects;
