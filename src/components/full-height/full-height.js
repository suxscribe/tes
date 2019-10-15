import Component from '../../common/js/component';
import _ from 'lodash';
import { DEBOUNCE_INTERVAL_MS } from '../../common/js/variables';

class FullHeight extends Component {
  constructor(nRoot, componentName, heightProp = 'min-height') {
    super(nRoot, componentName);
    this.heightProp = heightProp;
    this.updateHeight();
    this.updateHeight = _.debounce(this.updateHeight, DEBOUNCE_INTERVAL_MS).bind(this);
    this.enableFullHeight();
    this.disabled = false;
  }

  updateHeight() {
    if (!this.disabled) {
      this.nRoot.style[this.heightProp] = `${window.innerHeight}px`;
    }
  }

  enableFullHeight() {
    this.disabled = false;
    this.updateHeight();
    window.addEventListener('resize', this.updateHeight);
  }

  disableFullHeight() {
    this.disabled = true;
    this.nRoot.style.removeProperty(this.heightProp);
  }

  destroy() {
    window.removeEventListener('resize', this.updateHeight);
  }
}

export default FullHeight;
