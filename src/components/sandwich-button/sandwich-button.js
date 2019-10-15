import Component from '../../common/js/component';
import { nGetBody } from '../../common/js/helpers';
import { commonComponents } from '../../common/js/commonComponents';
import {
  appearAnim as appearAnimSandwich,
} from '../sandwich-menu/animations';

class SandwichButton extends Component {
  constructor(nRoot) {
    super(nRoot, 'sandwich-button');
    this.open = this.open.bind(this);
    this.nRoot.addEventListener('click', this.open);
    this.animation = null;
  }

  open() {
    commonComponents.header.nFindSingle('menu').classList.remove('no-transition');
    commonComponents.callbacks.call('sandwich-open');
    nGetBody().classList.add('sandwich-open');
    if (this.animation) {
      this.animation.kill();
    }
    this.animation = appearAnimSandwich(commonComponents.sandwichMenu, 0.1);
  }

  destroy() {
    this.nRoot.removeEventListener('click', this.toggle);
  }
}

export default SandwichButton;
