import Component from '../../common/js/component';
import { emit } from '../../common/js/helpers';
import $ from 'jquery';

class Specifications extends Component {
  constructor(nRoot) {
    super(nRoot, 'specifications');
    this.requestIscrollRefresh = this.requestIscrollRefresh.bind(this);
    $(this.nRoot).on('shown.bs.collapse', this.requestIscrollRefresh);
    $(this.nRoot).on('hidden.bs.collapse', this.requestIscrollRefresh);
  }

  requestIscrollRefresh() {
    emit('scrolling:request-iscroll-refresh');
  }

  destroy() {
    $(this.nRoot).off('shown.bs.collapse', this.requestIscrollRefresh);
    $(this.nRoot).off('hidden.bs.collapse', this.requestIscrollRefresh);
  }
}

export default Specifications;
