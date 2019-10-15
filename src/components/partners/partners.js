import Component from '../../common/js/component';
import TweenMax from 'TweenMax';
import { offset } from '../../common/js/helpers';
import { FIXED_HEADER_HEIGHT_PX } from '../../common/js/variables';

class Partners extends Component {
  constructor(nRoot) {
    super(nRoot, 'partners');
    this.onHidden = this.onHidden.bind(this);
    $(this.nFindSingle('collapse')).on('hidden.bs.collapse', this.onHidden);
  }

  onHidden() {
    TweenMax.to(
      window, 0.5, { scrollTo: { y: offset(this.nRoot).top - FIXED_HEADER_HEIGHT_PX } },
    );
  }

  destroy() {
    $(this.nFindSingle('collapse')).off('hidden.bs.collapse', this.onHidden);
  }
}

export default Partners;
