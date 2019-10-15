import Component from '../../common/js/component';
import Swiper from 'swiper';
import { getDeviceType, HeightBalancer, nFindComponents } from '../../common/js/helpers';

class CompetenceSlider extends Component {
  constructor(nRoot, parent) {
    super(nRoot, 'competence-slider');
    this.parent = parent;
    this.swiper = new Swiper(this.nFindSingle('swiper'), {
      slidesPerView: 2,
      keyboard: true,
      grabCursor: true,
      resistanceRatio: 0,
      navigation: {
        prevEl: this.parent.sliderNavigation.nFindSingle('arrow_prev'),
        nextEl: this.parent.sliderNavigation.nFindSingle('arrow_next'),
      }
    });
    const groupedItems = [
      this.nFind('item:nth-child(1)'),
      this.nFind('item:nth-child(2)'),
      this.nFind('item:nth-child(3)'),
    ];
    this.balancers = groupedItems.map(items => {
      return new HeightBalancer(items);
    });
  }

  destroy() {
    this.swiper.destroy();
    this.balancers.forEach(balancer => balancer.destroy());
  }
}

export default CompetenceSlider;
