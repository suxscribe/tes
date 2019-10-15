import Component from '../../common/js/component';
import { emit } from '../../common/js/helpers';
import $ from 'jquery';

class SpoilerList extends Component {
  constructor(nRoot) {
    super(nRoot, 'spoiler-list');
    this.requestIscrollRefresh = this.requestIscrollRefresh.bind(this);
    this.spoilers = this.nFind('item');
    this.spoilers.forEach(spoiler => {
      $(spoiler).on('shown.bs.collapse', this.requestIscrollRefresh);
      $(spoiler).on('hidden.bs.collapse', this.requestIscrollRefresh);
    });
  }

  requestIscrollRefresh() {
    emit('scrolling:request-iscroll-refresh');
  }

  destroy() {
    this.spoilers.forEach(spoiler => {
      $(spoiler).off('shown.bs.collapse', this.requestIscrollRefresh);
      $(spoiler).off('hidden.bs.collapse', this.requestIscrollRefresh);
    });
  }
}

export default SpoilerList;
