import Component from '../../common/js/component';
import {
  clearAnimation,
  getDeviceType,
  nFindComponent,
  nFindComponents
} from '../../common/js/helpers';
import Solution from '../solution/solution';
import Swiper from 'swiper';
import SolutionsNavigation from '../solutions-navigation/solutions-navigation';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';
import { SCREEN_MD_MIN_PX } from '../../common/js/variables';

class Solutions extends Component {
  static get AUTOROTATE_DELAY_MS() { return 10000; }
  static get CHANGE_SPEED_MS() { return 600; }

  constructor(nRoot) {
    super(nRoot, 'solutions');
    this.slides = nFindComponents(
      'solution',
      this.nRoot).map(nSlide => new Solution(nSlide),
    );
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.swiper = new Swiper(this.nFindSingle('slider'), {
      resistanceRatio: 0,
      speed: Solutions.CHANGE_SPEED_MS,
      autoplay: {
        delay: Solutions.AUTOROTATE_DELAY_MS,
        disableOnInteraction: false,
      },
      effect: 'fade',
      pagination: {
        el: this.mobileSliderNavigation.nFindSingle('progress'),
        type: 'progressbar',
      },
      navigation: {
        prevEl: this.mobileSliderNavigation.nFindSingle('prev'),
        nextEl: this.mobileSliderNavigation.nFindSingle('next'),
      },
      breakpointsInverse: {
        [SCREEN_MD_MIN_PX]: {
          allowTouchMove: false,
          effect: 'fade',
          fadeEffect: {
            crossFade: true,
          },
        },
      },
    });
    this.swiper.autoplay.stop();
    if (getDeviceType() !== 'mobile') {
      this.swiper.on('slideChangeTransitionStart', this.onSlideChangeTransitionStart.bind(this));
    }
    this.swiper.on('slideChangeTransitionEnd', () => {
      this.mobileSliderNavigation.setCurrent(this.swiper.realIndex + 1);
    });
    this.swiper.on('autoplayStart', () => {
      this.solutionsNavigation.setCurrentSlide(this.swiper.realIndex);
    });
    this.swiper.on('autoplayStop', () => {
      this.solutionsNavigation.clearActiveSlide();
    });
    this.solutionsNavigation = new SolutionsNavigation(
      nFindComponent('solutions-navigation', this.nRoot),
      this.swiper,
    );
  }

  get activeSlide() {
    return this.slides[this.swiper.realIndex];
  }

  onSlideChangeTransitionStart() {
    this.slides.forEach(slide => {
      slide.nRoot.classList.remove('change-from-this');
      slide.nRoot.classList.remove('change-to-this');
      clearAnimation(slide.nRoot);
    });
    this.slides[this.swiper.previousIndex].nRoot.classList.add('change-from-this');
    this.slides[this.swiper.realIndex].nRoot.classList.add('change-to-this');
    this.solutionsNavigation.setCurrentSlide(this.swiper.realIndex);
  }

  destroy() {
    clearInterval(this.progressIntervalId);
    this.slides.forEach(slide => slide.destroy());
    this.swiper.destroy();
    this.solutionsNavigation.destroy();
    this.mobileSliderNavigation.destroy();
  }
}

export default Solutions;
