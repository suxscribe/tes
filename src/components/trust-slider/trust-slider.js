import Swiper from 'swiper';
import Component from '../../common/js/component';
import GalleryNavigation from '../gallery-navigation/gallery-navigation';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';
import {
  getDeviceType,
  nFindComponent,
  Clamper,
  Resize,
  listen, unlisten,
} from '../../common/js/helpers';

class TrustSlider extends Component {
  constructor(nRoot) {
    super(nRoot, 'trust-slider');
    this.currentDevice = getDeviceType();
    this.afterResize = this.afterResize.bind(this);
    this.numeration = this.nFindSingle('numeration');
    this.galleryNavigation = new GalleryNavigation(nFindComponent('gallery-navigation'), this.nRoot);
    this.mobileSliderNavigation = new MobileSliderNavigation(nFindComponent('mobile-slider-navigation', this.nRoot));
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop();
    }
    this.resize = new Resize();
    listen('deviceType:after-resize', this.afterResize);
  }

  setCurrentNumeration(value) {
    this.numeration.innerHTML = (value).toString().padStart(2, 0);
  }

  initDesktop() {
    this.swiper = new Swiper(this.nFindSingle('swiper-container'), {
      slidesPerView: 1,
      loop: true,
      speed: 600,
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      navigation: {
        nextEl: this.galleryNavigation.nFind('arrow_next'),
        prevEl: this.galleryNavigation.nFind('arrow_prev'),
      },
      pagination: {
        el: this.mobileSliderNavigation.nFind('progress'),
        type: 'progressbar',
      },
      keyboard: {
        enabled: true,
        onlyInViewport: true,
      },
    });
    this.swiper.on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.swiper.realIndex + 1));

    this.swiper.on('slideChange', () => this.setCurrentNumeration(this.swiper.realIndex + 1));

    this.clampers = this.nFind('comment')
      .map(nComment => new Clamper(nComment, 5));
  }

  initMobile() {
    this.swiper = new Swiper(this.nFindSingle('swiper-container'), {
      loop: true,
      speed: 600,
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
      pagination: {
        el: this.mobileSliderNavigation.nFind('progress'),
        type: 'progressbar',
      },
      navigation: {
        prevEl: this.mobileSliderNavigation.nFindSingle('prev'),
        nextEl: this.mobileSliderNavigation.nFindSingle('next'),
      },
    });
    this.swiper.on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.swiper.realIndex + 1));
    this.clampers = this.nFind('comment')
      .map(nComment => new Clamper(nComment, 8));
  }

  afterResize() {
    if (getDeviceType() !== this.currentDevice) {
      this.swiper.destroy();
      this.clampers.forEach(clamper => clamper.destroy());
      if (getDeviceType() === 'mobile') {
        this.initMobile();
      } else {
        this.initDesktop();
      }
      this.currentDevice = getDeviceType();
    }
  }

  destroy() {
    this.resize.destroy();
    unlisten('deviceType:after-resize', this.afterResize);
    this.galleryNavigation.destroy();
    this.mobileSliderNavigation.destroy();
    this.clampers.forEach(clamper => clamper.destroy());
    this.swiper.destroy();
  }
}

export default TrustSlider;
