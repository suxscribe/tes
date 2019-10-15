import Component from '../../common/js/component';
import Swiper from 'swiper';
import { nFindComponent } from '../../common/js/helpers';
import MobileSliderNavigation from '../mobile-slider-navigation/mobile-slider-navigation';


class CompetenceMobile extends Component {
  constructor(nRoot) {
    super(nRoot, 'competence-mobile');
    this.mobileSliderNavigation = new MobileSliderNavigation(nFindComponent('mobile-slider-navigation', this.nRoot), this);
    this.swiper = new Swiper(this.nFindSingle('swiper', this.nRoot), {
      pagination: {
        el: this.mobileSliderNavigation.nFindSingle('progress'),
        type: 'progressbar',
      },
      navigation: {
        nextEl: this.mobileSliderNavigation.nFind('next'),
        prevEl: this.mobileSliderNavigation.nFind('prev'),
      },
    });
    this.swiper.on('slideChange', () => this.mobileSliderNavigation.setCurrent(this.swiper.realIndex + 1));
  }

  destroy() {
    this.swiper.destroy();
    this.mobileSliderNavigation.destroy();
  }
}

export default CompetenceMobile;
