import Component from '../../common/js/component';
import {
  getDeviceType,
  nFindComponent
} from '../../common/js/helpers';
import Swiper from 'swiper';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';
import SolutionsNavigation from '../solutions-navigation/solutions-navigation';

class AppliedPerformances extends Component {
  constructor(nRoot) {
    super(nRoot, 'applied-performances');
    this.mobileSliderNavigation = new MobileSliderNavigation(
      nFindComponent('mobile-slider-navigation', this.nRoot),
    );
    this.swiper = new Swiper(this.nFindSingle('slider'), {
      resistanceRatio: 0,
      grabCursor: true,
      pagination: {
        el: this.mobileSliderNavigation.nFindSingle('progress'),
        type: 'progressbar',
      },
      navigation: {
        prevEl: this.mobileSliderNavigation.nFindSingle('prev'),
        nextEl: this.mobileSliderNavigation.nFindSingle('next'),
      },
    });
    this.swiper.on('slideChangeTransitionStart', this.onSlideChangeTransitionStart.bind(this));
    this.swiper.on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.swiper.realIndex + 1));
    this.solutionsNavigation = new SolutionsNavigation(
      nFindComponent('solutions-navigation', this.nRoot),
      this.swiper,
    );
  }

  get activeSlide() {
    return this.slides[this.swiper.realIndex];
  }

  onSlideChangeTransitionStart() {
    this.solutionsNavigation.setCurrentSlide(this.swiper.realIndex);
  }

  destroy() {
    this.swiper.destroy();
    this.solutionsNavigation.destroy();
    this.mobileSliderNavigation.destroy();
  }
}

export default AppliedPerformances;
