import Component from '../../common/js/component';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';
import { nGetBody, offset } from '../../common/js/helpers';
import { commonComponents } from '../../common/js/commonComponents';
import TweenMax from 'TweenMax';

class Footer extends Component {
  constructor(nRoot) {
    super(nRoot, 'footer');
  }

  setFullOpacity(value) {
    if (value) {
      this.nRoot.classList.add('footer__full-opacity');
    } else {
      this.nRoot.classList.remove('footer__full-opacity');
    }
  }

  fixToContainerBottom(nContainer) {
    nContainer.appendChild(commonComponents.footer.nRoot);
    commonComponents.footer.nRoot.style.position = 'absolute';
    commonComponents.footer.setFullOpacity(true);
    commonComponents.footer.nRoot.classList.add('footer_big');
  }

  cancelFix() {
    nGetBody().appendChild(commonComponents.footer.nRoot);
    commonComponents.footer.nRoot.style.removeProperty('position');
    commonComponents.footer.setFullOpacity(false);
    commonComponents.footer.nRoot.classList.remove('footer_big');
  }

  destroy() {
    window.removeEventListener('resize', this.onResize);
  }
}

export default Footer;
