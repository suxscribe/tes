import Component from '../../common/js/component';
import Swiper from 'swiper';
import _ from 'lodash';
import SliderNavigation from '../slider-navigation/slider-navigation';
import {
  calculateColWidth,
  getDeviceType,
  listen,
  nFindComponent,
  Resize, unlisten
} from '../../common/js/helpers';
import {
  DEBOUNCE_INTERVAL_MS,
  SCREEN_XXL_MIN_PX,
  SCREEN_XL_MIN_PX,
  SCREEN_MD_MIN_PX,
} from '../../common/js/variables';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';

class Advantages extends Component {
  constructor(nRoot) {
    super(nRoot, 'advantages');
    this.currentDevice = getDeviceType();
    this.afterResize = this.afterResize.bind(this);
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop();
    }
    this.resize = new Resize();
    listen('deviceType:after-resize', this.afterResize);
  }

  initDesktop() {
    this.advantagesNavigation = new SliderNavigation(
      nFindComponent('slider-navigation_advantages'),
      this.nRoot,
    );
    this.swiper = new Swiper(this.nFindSingle('swiper-container'), {
      slidesPerView: 4,
      loop: false,
      grabCursor: true,
      breakpoints: {
        [SCREEN_XXL_MIN_PX - 1]: {
          slidesPerView: 3,
        },
        [SCREEN_XL_MIN_PX - 1]: {
          slidesPerView: 2,
        },
        [SCREEN_MD_MIN_PX - 1]: {
          slidesPerView: 1,
        },
      },
      navigation: {
        nextEl: this.advantagesNavigation.nFind('arrow_next'),
        prevEl: this.advantagesNavigation.nFind('arrow_prev'),
      },
      keyboard: {
        enabled: true,
        onlyInViewport: true,
      },
    });
    this.onResize();
    this.onResize = _.debounce(this.onResize.bind(this), DEBOUNCE_INTERVAL_MS);
    window.addEventListener('resize', this.onResize);
  }

  onResize() {
    if (!this.swiper.params) {
      return;
    }
    this.updateSpaceBetween();
    if (this.swiper.slides.length > 4
      || (this.swiper.slides.length > 3 && window.innerWidth < SCREEN_XXL_MIN_PX)
      || (this.swiper.slides.length > 2 && window.innerWidth < SCREEN_XL_MIN_PX)) {
      nFindComponent('slider-navigation', this.nRoot).style.removeProperty('opacity');
      nFindComponent('slider-navigation', this.nRoot).style.removeProperty('visibility');
      this.swiper.allowTouchMove = true;
      this.swiper.setGrabCursor();
    } else {
      nFindComponent('slider-navigation', this.nRoot).style.opacity = '0';
      nFindComponent('slider-navigation', this.nRoot).style.visibility = 'hidden';
      this.swiper.allowTouchMove = false;
      this.swiper.unsetGrabCursor();
    }
  }

  initMobile() {
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.mobileSwiper = new Swiper(this.nFindSingle('swiper-container'), {
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

  updateSpaceBetween() {
    if (matchMedia(`(min-width: ${SCREEN_XL_MIN_PX}px)`).matches) {
      this.swiper.params.spaceBetween = calculateColWidth() / 4;
    } else {
      this.swiper.params.spaceBetween = calculateColWidth() / 2;
    }
    this.swiper.update();
  }

  afterResize() {
    if (getDeviceType() !== this.currentDevice) {
      if (getDeviceType() === 'mobile') {
        this.advantagesNavigation.destroy();
        this.swiper.destroy();
        window.removeEventListener('resize', this.onResize);
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
    this.resize.destroy();
    unlisten('deviceType:after-resize', this.afterResize);
    if (getDeviceType() === 'mobile') {
      this.mobileSwiper.destroy();
      this.mobileSliderNavigation.destroy();
    } else {
      this.advantagesNavigation.destroy();
      this.swiper.destroy();
      window.removeEventListener('resize', this.onResize);
    }
  }
}

export default Advantages;
