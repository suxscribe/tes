import Component from '../../common/js/component';
import Swiper from 'swiper';
import { getDeviceType, nFindComponent } from '../../common/js/helpers';
import CompetenceSlider from '../competence-slider/competence-slider';
import SliderNavigation from '../slider-navigation/slider-navigation';

class Competence extends Component {
  constructor(nRoot) {
    super(nRoot, 'competence');
    this.sliderNavigation = new SliderNavigation(nFindComponent('slider-navigation', this.nRoot), this);
    this.slider = new CompetenceSlider(nFindComponent('competence-slider', this.nRoot), this);
    if (this.slider.swiper.slides.length <= 2) {
      nFindComponent('slider-navigation', this.nRoot).style.opacity = '0';
      nFindComponent('slider-navigation', this.nRoot).style.visibility = 'hidden';
      this.slider.swiper.allowTouchMove = false;
      this.slider.swiper.unsetGrabCursor();
    }
  }

  destroy() {
    this.slider.destroy();
    this.sliderNavigation.destroy();
  }
}

export default Competence;
