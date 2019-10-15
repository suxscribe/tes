import FullHeight from '../full-height/full-height';
import { getDeviceType, nFindComponent, isIE, nFindComponents } from '../../common/js/helpers';
import ElectroLines from '../electro-lines/electro-lines';
import Service from '../service/service';

class Services extends FullHeight {
  constructor(nRoot) {
    super(nRoot, 'services');
    this.services = nFindComponents('service', this.nRoot).map(nService => new Service(nService));
    if (getDeviceType() !== 'mobile') {
      this.initDesktop();
    } else {
      this.initMobile();
    }
  }

  initDesktop() {
    this.electroLines = new ElectroLines(nFindComponent('electro-lines', this.nRoot), this);
    this.disableElectroLines();
  }

  initMobile() {
    this.disableFullHeight();
  }

  enableElectroLines() {
    if (isIE()) {
      return;
    }
    this.electroLines.paused = false;
  }

  disableElectroLines() {
    this.electroLines.paused = true;
  }

  destroy() {
    this.services.forEach(service => service.destroy());
    if (this.swiper) {
      this.swiper.destroy();
    }
    if (getDeviceType() !== 'mobile' && this.electroLines) {
      this.electroLines.destroy();
    }
  }
}

export default Services;
