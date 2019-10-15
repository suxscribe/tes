import Swiper from 'swiper';
import $ from 'jquery';
import Component from '../../common/js/component';
import SliderNavigation from '../slider-navigation/slider-navigation';
import {
  getDeviceType,
  nFindComponent,
  nFindComponents,
} from '../../common/js/helpers';
import ProductMapSlide from '../product-map-slide/product-map-slide';
import {
  appearAnim as appearAnimSlide,
} from '../product-map-slide/animations';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';

class ProductMapSlider extends Component {
  constructor(nRoot) {
    super(nRoot, 'product-map-slider');
    this.slides = nFindComponents(
      'product-map-slide',
      this.nRoot,
    ).map(nSlide => new ProductMapSlide(nSlide));
    if (getDeviceType() === 'mobile') {
      this.initMobile();
    } else {
      this.initDesktop();
    }
  }

  initDesktop() {
    this.mapNavigation = new SliderNavigation(
      nFindComponent('slider-navigation_map'),
      this.nRoot,
    );
    this.swiper = new Swiper(this.nFindSingle('slider'), {
      // autoHeight: true,
      resistanceRatio: 0,
      allowTouchMove: false,
      speed: 600,
      loop: false,
      observer: true,
      observeParents: true,
      observeSlideChildren: true,
      navigation: {
        nextEl: this.mapNavigation.nFind('arrow_next'),
        prevEl: this.mapNavigation.nFind('arrow_prev'),
      },
      pagination: {
        el: '.slider-pagination_map',
        clickable: true,
        renderBullet(index, className) {
          index += 1;
          index = index.toString();
          index = index.padStart(2, '0');
          return `<span class="${className}">${index}</span>`;
        },
      },
      keyboard: {
        enabled: true,
        onlyInViewport: true,
      },
      effect: 'fade',
      fadeEffect: {
        crossFade: true,
      },
    });
    this.swiper.on('slideChange', this.onSlideChange.bind(this));
    this.onSliderClose = this.onSliderClose.bind(this);
    this.nFindSingle('back').addEventListener('click', this.onSliderClose);
  }

  getState() {
    return {
      swiperActiveIndex: this.swiper.activeIndex,
    };
  }

  restoreState(state) {
    this.swiper.slideTo(state.swiperActiveIndex, 0);
  }

  initMobile() {
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.swiper = new Swiper(this.nFindSingle('slider'), {
      resistanceRatio: 0,
      speed: 600,
      loop: false,
      effect: 'fade',
      pagination: {
        el: this.mobileSliderNavigation.nFindSingle('progress'),
        type: 'progressbar',
      },
      navigation: {
        prevEl: this.mobileSliderNavigation.nFindSingle('prev'),
        nextEl: this.mobileSliderNavigation.nFindSingle('next'),
      },
    });
    this.swiper.on('slideChange', () => {
      this.mobileSliderNavigation.setCurrent(this.swiper.realIndex + 1);
      this.slides.map(slide => slide.hideDesc());
    });
    this.slides.forEach(slide => slide.initToggle());
  }

  async onSliderClose() {
    appearAnimSlide(this.activeSlide).reverse(0).timeScale(2.5);
    this.nRoot.classList.add('product-map-slider_hide');
    this.swiper.update();
    $.fn.fullpage.setAllowScrolling(true);
  }

  get activeSlide() {
    return this.slides[this.swiper.realIndex];
  }

  onSlideChange() {
    appearAnimSlide(this.activeSlide);
  }

  destroy() {
    this.slides.forEach(slide => slide.destroy());
    if (getDeviceType() === 'mobile') {
      this.swiper.destroy();
      this.mobileSliderNavigation.destroy();
    } else {
      this.swiper.destroy();
      this.nFindSingle('back').removeEventListener('click', this.onSliderClose);
    }
  }
}

export default ProductMapSlider;
