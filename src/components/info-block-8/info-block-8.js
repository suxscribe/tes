import { getDeviceType } from '../../common/js/helpers';
import Component from '../../common/js/component';

class InfoBlock8 extends Component {
  constructor(nRoot) {
    super(nRoot, 'info-block-8');
    this.deviceType = getDeviceType();
    if (this.deviceType !== 'mobile') {
      this.initDesktop();
    } else {
      this.initMobile();
    }
  }

  initDesktop() {
    window.addEventListener('resize', this.updateHeight);
  }

  initMobile() {
    
  }

  destroy() {
    window.removeEventListener('resize', this.updateHeight);
  }
}

export default InfoBlock8;
