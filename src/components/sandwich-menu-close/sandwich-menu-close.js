import Component from '../../common/js/component';
import { nGetBody } from '../../common/js/helpers';
import { commonComponents } from '../../common/js/commonComponents';

class SandwichMenuClose extends Component {
  constructor(nRoot) {
    super(nRoot, 'sandwich-menu-close');
    this.close = this.close.bind(this);
    this.nRoot.addEventListener('click', this.close);
  }

  close(callCalbacks = true) {
    commonComponents.header.nFindSingle('menu').classList.remove('no-transition');
    if (callCalbacks) {
      commonComponents.callbacks.call('sandwich-close');
    }
    nGetBody().classList.remove('sandwich-open');
  }

  destroy() {
    this.nRoot.removeEventListener('click', this.close);
  }
}

export default SandwichMenuClose;
