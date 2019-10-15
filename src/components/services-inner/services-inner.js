import Component from '../../common/js/component';
import { HeightBalancer, nFindComponents } from '../../common/js/helpers';
import Swiper from 'swiper';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS, SCREEN_MD_MIN_PX } from '../../common/js/variables';

class ServicesInner extends Component {
  constructor(nRoot) {
    super(nRoot, 'services-inner');
    this.heightBalancer = new HeightBalancer(
      nFindComponents('service-inner', this.nRoot, )
        .map(nService => nService.querySelector('.service-inner__text')),
    );
  }

  destroy() {
    this.heightBalancer.destroy();
  }
}

export default ServicesInner;
