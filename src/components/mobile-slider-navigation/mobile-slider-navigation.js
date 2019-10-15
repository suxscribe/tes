import Component from '../../common/js/component';

class MobileSliderNavigation extends Component {
  constructor(nRoot) {
    super(nRoot, 'mobile-slider-navigation');
  }

  setCurrent(value) {
    this.nFindSingle('current').innerHTML = (value).toString().padStart(2, 0);
  }

  destroy() {

  }
}

export default MobileSliderNavigation;
